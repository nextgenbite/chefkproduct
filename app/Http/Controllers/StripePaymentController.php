<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Stripe;


class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($data)
    {
        return view('stripe', compact('data'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)

    {
      // return $request->id;
      if ($request->id) {
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
          $order = Order::findOrFail($request->id);
        $customer = Stripe\Customer::create(array(
    
                "address" => [
    
                        "line1" => $order->address,
    
                        "postal_code" => "360001",
    
                        "city" => "Rajkot",
    
                        "state" => "GJ",
    
                        "country" => "IN",
    
                    ],
    
                "email" => "demo@gmail.com",
    
                "name" =>  $order->name,
    
                "source" => $request->stripeToken
    
             ));
    
      
    
      $data=  Stripe\Charge::create ([
    
                "amount" =>  round($order->total) * 100,
    
                "currency" => "usd",
    
                "customer" => $customer->id,
    
                "description" => "Test payment from nuxtshop.",
    
                "shipping" => [
    
                  "name" =>  $order->name,
    
                  "address" => [
    
                    "line1" => $order->address,
    
                    "postal_code" => "98140",
    
                    "city" => "San Francisco",
    
                    "state" => "CA",
    
                    "country" => "US",
    
                  ],
    
                ]
    
        ]); 
        if($data->status == "succeeded")
        {
          $order->update(['payment_status' => 'paid']);
          Session::flash('success', 'Payment successful!');
          return view('frontend.order_success', compact('order'));

        }else{
          Session::flash('success', 'Payment faild!');
        }
      
    
    
               
    
      }else{

        Session::flash('error', 'Order id not found!');
      }
      return $data;
    
      
    
    
    }
}
