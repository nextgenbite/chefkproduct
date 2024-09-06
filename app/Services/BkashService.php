<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class BkashService
{
    private $base_url;

    // protected $baseUrl;
    protected $appKey;
    protected $appSecret;
    protected $username;
    protected $password;
    public function __construct()
    {
        $this->base_url = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/";
        $this->appKey = env('BKASH_CHECKOUT_APP_KEY');
        $this->appSecret = env('BKASH_CHECKOUT_APP_SECRET');
        $this->username = env('BKASH_CHECKOUT_USER_NAME');
        $this->password = env('BKASH_CHECKOUT_PASSWORD');
    }

    public function getToken()
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'username' => $this->username,
                'password' => $this->password
            ])->post($this->base_url . 'checkout/token/grant', [
                'app_key' => $this->appKey,
                'app_secret' => $this->appSecret
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['id_token'])) {
                return $data['id_token'];
            } else {
                Log::error('Failed to retrieve bKash id_token:', [
                    'response' => $data,
                    'status_code' => $response->status(),
                    'headers' => $response->headers(),
                ]);
                throw new Exception('Failed to retrieve bKash id_token: ' . ($data['error'] ?? 'Unknown error'));
            }
        } catch (Exception $e) {
            Log::error('bKash Token Request Failed:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    public function createPayment($amount, $invoice)
    {
        $token = $this->getToken();
        if ($token) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $token,
                    'X-APP-Key' => $this->appKey,
                ])->post($this->base_url . 'checkout/create', [
                    'mode' => '0011',
                    'payerReference' => ' ',
                    'callbackURL' => 'https://ecomapi.nextgenbite.xyz/',
                    'amount' => $amount,
                    'currency' => 'BDT',
                    'intent' => 'sale',
                    'merchantInvoiceNumber' => $invoice
                ]);

                $data = $response->json();

                if ($response->successful() && isset($data['bkashURL'])) {
                    return redirect($data['bkashURL']);
                } else {
                    Log::error('Failed to create bKash payment:', ['response' => $data]);
                    throw new Exception('Failed to create bKash payment: ' . ($data['errorMessage'] ?? 'Unknown error'));
                }
            } catch (Exception $e) {
                Log::error('bKash Payment Creation Failed:', ['error' => $e->getMessage()]);
                throw $e;
            }
        }
    }

    public function executePayment($paymentID)
    {
        $token = $this->getToken();

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $token,
                'X-APP-Key' => env('BKASH_CHECKOUT_APP_KEY')
            ])->post($this->base_url . 'checkout/execute', [
                'paymentID' => $paymentID
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['paymentID'])) {
                return $data;
            } else {
                Log::error('Failed to execute bKash payment:', ['response' => $data]);
                throw new Exception('Failed to execute bKash payment: ' . ($data['errorMessage'] ?? 'Unknown error'));
            }
        } catch (Exception $e) {
            Log::error('bKash Payment Execution Failed:', ['error' => $e->getMessage()]);
            throw $e;
        }



        // public function __construct()
        // {
        //     $this->baseUrl = env('BKASH_BASE_URL');
        //     $this->appKey = env('BKASH_CHECKOUT_APP_KEY');
        //     $this->appSecret = env('BKASH_CHECKOUT_APP_SECRET');
        //     $this->username = env('BKASH_CHECKOUT_USER_NAME');
        //     $this->password = env('BKASH_CHECKOUT_PASSWORD');

        //     // $this->baseUrl = config('bkash.base_url');
        //     // $this->appKey = config('bkash.app_key');
        //     // $this->appSecret = config('bkash.app_secret');
        //     // $this->username = config('bkash.username');
        //     // $this->password = config('bkash.password');
        // }

        // public function createPayment($amount, $invoice)
        // {
        //     $client = new Client();
        //     $response = $client->post($this->baseUrl . 'checkout/create', [
        //         'headers' => [
        //             'Content-Type' => 'application/json',
        //             'Authorization' => 'Bearer ' . $this->getToken(),
        //         ],
        //         'json' => [
        //             'amount' => $amount,
        //             'currency' => 'BDT',
        //             'merchantInvoiceNumber' => $invoice,
        //             'intent' => 'sale'
        //         ],
        //     ]);

        //     return json_decode($response->getBody(), true);
        // }

        // public function executePayment($paymentID)
        // {
        //     $client = new Client();
        //     $response = $client->post($this->baseUrl . 'checkout/payment/execute/' . $paymentID, [
        //         'headers' => [
        //             'Content-Type' => 'application/json',
        //             'Authorization' => 'Bearer ' . $this->getToken(),
        //         ],
        //     ]);

        //     return json_decode($response->getBody(), true);
        // }

        // protected function getToken()
        // {
        //     $client = new Client();
        //     $response = $client->post($this->baseUrl . 'checkout/token/grant', [
        //         'auth' => [$this->username, $this->password],
        //         'json' => [
        //             'app_key' => $this->appKey,
        //             'app_secret' => $this->appSecret,
        //         ],
        //     ]);

        //     $data = json_decode($response->getBody(), true);

        //     // Log the response for debugging purposes
        //     \Log::info('bKash Token Response:', $data);

        //     if (isset($data['id_token'])) {
        //         return $data['id_token'];
        //     } else {
        //         // Handle the error case
        //         throw new \Exception('Failed to retrieve bKash id_token: ' . ($data['error'] ?? 'Unknown error'));
        //     }
        // }

    }
}
