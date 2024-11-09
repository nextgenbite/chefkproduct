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

                    "description" => "Order payment from".config('app.name')

                ]);
                return $data;
                            
            } catch (Exception $e) {
                Log::error('stripe Payment Creation Failed:', ['error' => $e->getMessage()]);
                throw $e;
            }
     
    }
}
