<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class FedexService
{
    protected $production_url = 'https://apis.fedex.com';
    protected $testing_url = 'https://apis-sandbox.fedex.com';

    private $client_id;
    private $client_secret;
    private $accountNumber;
    public $production_mode;

    public function __construct()
    {
        $this->client_id = env('FEDEX_CLIENT_ID');
        $this->client_secret = env('FEDEX_CLIENT_SECRET');
        $this->accountNumber = env('FEDEX_ACCOUNT_NUMBER');
        $this->production_mode = env('FEDEX_MODE') === 'production';
    }

    /**
     * Get the FedEx API URI based on the environment.
     */
    public function getApiUri(string $endpoint = ''): string
    {
        return ($this->production_mode ? $this->production_url : $this->testing_url) . $endpoint;
    }

    /**
     * Authorize and retrieve OAuth token.
     *
     * @return string|null
     * @throws Exception
     */
    public function authorize(): ?string
    {
        $httpClient = new Client();

        try {
            $response = $httpClient->post($this->getApiUri('/oauth/token'), [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody()->getContents());
                return $data->access_token ?? null;
            }
        } catch (Exception $e) {
            Log::error("FedEx Authorization Error: " . $e->getMessage());
            throw new Exception('Authorization failed: ' . $e->getMessage());
        }

        return null;
    }


       /**
     * Get the shipping rates from FedEx.
     *
     * @param array $shipmentDetails
     * @return mixed
     * @throws Exception
     */
    public function getRateQuotes(array $shipmentDetails): ?array
    {
        $httpClient = new Client();
        $token = $this->authorize();
    
        if (!$token) {
            throw new Exception('Unable to obtain authorization token.');
        }
    
        // Define the request payload
        $payload = [
            "accountNumber" => [
                "value" => $this->accountNumber, // Make sure to set your account number here
            ],
            "rateRequestControlParameters" => [
                "returnTransitTimes" => false,
                "servicesNeededOnRateFailure" => true,
                "variableOptions" => "FREIGHT_GUARANTEE",
                "rateSortOrder" => "SERVICENAMETRADITIONAL"
            ],
            "requestedShipment" => $shipmentDetails,
            "carrierCodes" => [
                "FDXE", // FedEx Express
                "FDXG", // FedEx Ground
            ]
        ];
    
        try {
            $response = $httpClient->post($this->getApiUri('/rate/v1/rates/quotes'), [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);
    
            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody()->getContents(), true);
            }
        } catch (Exception $e) {
            Log::error("FedEx Rate Retrieval Error: " . $e->getMessage());
            Log::error("Request Payload: " . json_encode($payload));
            throw new Exception('Rate retrieval failed: ' . $e->getMessage());
        }
    
        return null;
    }
    
}
