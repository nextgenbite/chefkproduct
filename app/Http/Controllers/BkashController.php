<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\BkashService;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

use function PHPUnit\Framework\returnValue;

class BkashController extends Controller
{
    protected $bkashService;
    private $base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/';
    public function __construct(BkashService $bkashService)
    {
        $this->bkashService = $bkashService;
    }


    public function createPayment(Order $order)
    {
        // Get the total amount from the order
        $amount = $order->total;
        $invoice = $order->code;  // You can use the order code as the invoice number

        // Initiate payment request with bKash
       return $response = $this->bkashService->createPayment($amount, $invoice);

        // Check if the payment request was successful
        if (isset($response['paymentID'])) {
            // Save the payment ID in the order for reference
            $order->payment_id = $response['paymentID'];
            $order->save();

            // Return the response or redirect the user to bKash payment page
            return redirect()->away($response['bkashURL']);
        }

        // Handle failure
        return response()->json(['message' => 'bKash payment initiation failed'], 500);
    }

    public function executePayment(Request $request)
    {
        $paymentID = $request->input('paymentID');
        $response = $this->bkashService->executePayment($paymentID);

        return response()->json($response);
    }
    // public function __construct($bkash_sandbox)
    // {
    //     if($bkash_sandbox == 1){
    //         $this->base_url = "https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized/";
    //     }
    //     else {
    //         $this->base_url = "https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized/";
    //     }
    // }

    public function pay(){
        $amount = 0;
        if(Session::has('payment_type')){
            if(Session::get('payment_type') == 'cart_payment'){
                $order = Order::findOrFail(Session::get('order_id'));
                $amount = round($order->total);
            }
        }

        Session::forget('bkash_token');
        Session::put('bkash_token', $this->getToken());
        Session::put('amount', $amount);
        return redirect()->route('bkash.create_payment');
    }

    public function create_payment(){

        $requestbody = array(
            'mode' => '0011',
            'payerReference' => ' ',
            'callbackURL' => url('/'),
            'amount' => 10,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "Inv".Date('YmdH').rand(1000, 10000)
        );
        $requestbodyJson = json_encode($requestbody);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . env('BKASH_CHECKOUT_APP_SECRET'),
            'X-APP-Key:'.env('BKASH_CHECKOUT_APP_KEY')
        );

        $url = curl_init($this->base_url.'checkout/create');
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);

        return redirect(json_decode($resultdata)->bkashURL);
    }

    // public function getToken(){
    //     $request_data = array('app_key'=> env('BKASH_CHECKOUT_APP_KEY'), 'app_secret'=>env('BKASH_CHECKOUT_APP_SECRET'));
    //     $request_data_json=json_encode($request_data);

    //     $header = array(
    //             'Content-Type:application/json',
    //             'username:'.env('BKASH_CHECKOUT_USER_NAME'),
    //             'password:'.env('BKASH_CHECKOUT_PASSWORD')
    //             );
       
    //     $url = curl_init($this->base_url.'checkout/token/grant');
    //     curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    //     curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($url,CURLOPT_POSTFIELDS, $request_data_json);
    //     curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //     curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

    //     $resultdata = curl_exec($url);
    //     curl_close($url);

    //     $token = json_decode($resultdata)->id_token;
    //     return $token;
    // }

    public function callback(Request $request)
    {
        $allRequest = $request->all();
        if(isset($allRequest['status']) && $allRequest['status'] == 'failure'){
            return view('frontend.bkash.fail')->with([
                'errorMessage' => 'Payment Failure'
            ]);

        }else if(isset($allRequest['status']) && $allRequest['status'] == 'cancel'){
            return view('frontend.bkash.fail')->with([
                'errorMessage' => 'Payment Cancelled'
            ]);

        }else{
            
            $resultdata = $this->execute($allRequest['paymentID']);
            Session::forget('payment_details');
            Session::put('payment_details', $resultdata);

            $result_data_array = json_decode($resultdata,true);
            if(array_key_exists("statusCode",$result_data_array) && $result_data_array['statusCode'] != '0000'){
                return view('frontend.bkash.fail')->with([
                    'errorMessage' => $result_data_array['statusMessage'],
                ]);
            }else if(array_key_exists("statusMessage",$result_data_array)){
                // if execute api failed to response
                sleep(1);
                $resultdata = $this->query($allRequest['paymentID']);
                
                if($resultdata['transactionStatus'] == 'Initiated'){
                    return redirect()->route('bkash.create_payment');
                }
            }
            
            return redirect()->route('bkash.success');
        }

    }

    public function execute($paymentID) {
    
        $auth = Session::get('bkash_token');
        
        $requestbody = array(
            'paymentID' => $paymentID
        );
        $requestbodyJson = json_encode($requestbody);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:'.env('BKASH_CHECKOUT_APP_KEY')
        );

        $url = curl_init($this->base_url.'checkout/execute');
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        
        return $resultdata;
    }

    public function query($paymentID){
    
        $auth = Session::get('bkash_token');
        
        $requestbody = array(
            'paymentID' => $paymentID
        );
        $requestbodyJson = json_encode($requestbody);

        $header = array(
            'Content-Type:application/json',
            'Authorization:' . $auth,
            'X-APP-Key:'.env('BKASH_CHECKOUT_APP_KEY')
        );

        $url = curl_init($this->base_url.'checkout/payment/status');
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $requestbodyJson);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        
        return $resultdata;
    }


    public function success(Request $request){
        $payment_type = Session::get('payment_type');

        if ($payment_type == 'cart_payment') {
            // return (new CheckoutController)->checkout_done(Session::get('combined_order_id'), $request->payment_details);
        }
        }
}
