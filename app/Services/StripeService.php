<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Stripe;

class StripeService
{
    // protected $token;
    // public function __construct()
    // {
    //     $this->token = env('BKASH_CHECKOUT_APP_KEY');
    // }

    public function createPayment(Order $order, $token)
    {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
            try {
               $data = Stripe\Charge::create([

                    "amount" => 100 * 100,

                    "currency" => "usd",

                    "source" => $token,

                    "description" => "Test payment from nextgenbite.com."

                ]);
                if ($data->status == "succeeded") {
                    // $order->update(['payment_status' => 'paid']);
                    Session::flash('success', 'Payment successful!');
                    return view('frontend.order_success', compact('order'));
                } else {
                    Session::flash('success', 'Payment faild!');
                    Log::error('Failed to create stripe payment:', ['response' => $data]);
                    throw new Exception('Failed to create stripe payment: ' . ($data['errorMessage'] ?? 'Unknown error'));
                }
                return $data;
            } catch (Exception $e) {
                Log::error('stripe Payment Creation Failed:', ['error' => $e->getMessage()]);
                throw $e;
            }
     
    }
}
