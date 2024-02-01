<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => ["required", "min:3"],
            "phone" => ["required", "min:11"],
            "address" => ["required"],
        ]);
        $cart = session('cart');
        if (isset($cart['data']) && is_array($cart['data'])) 
        {

            $user = User::firstOrNew(['phone' => $request->phone], [
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "password" => Hash::make($request->phone),
            ]);
    
            if (!$user->exists) {
                $user->save();
            }
    
            $data = Order::create([
                "name" => $request->name,
                'code' => date('Ymd-His') . rand(10, 99),
                "phone" => $request->phone,
                "address" => $request->address,
                "total" => $cart['total_price'],
                "shipping_cost" => $cart['shipping_cost'],
                "order_date" => date("d/m/Y"),
                "order_month" => date("m"),
                "order_year" => date("Y"),
                "order_year" => date("Y"),
                'payment_mehood' => $request?->payment_method
            ]);
    
            foreach ($cart['data'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $product->decrement('stock', $item['quantity']);
    
                // $price = $item['price'] - ($item['price'] / 100) * $item['discount'];
    
                OrderItem::create([
                    "order_id" => $data->id,
                    "product_id" => $item['product_id'],
                    "qty" => $item['quantity'],
                    "total" => $item['price'] * $item['quantity'],
                    // "total" => $price * $item['quantity'],
                ]);
            }
            // return $request->payment_method;

         
            if ($request->payment_method == 'stripe') {
                // $html = View::make('frontend.partials.modal', compact('data'))->render();

                // return response()->json(['html' => $html]);

               return (new StripePaymentController())->stripe($data);
            //    if ( $stripeData) 
            //    {
            //     # code...
            //     return view('frontend.order_success', compact('data'));
            //    }
            }elseif ($request->payment_method == 'paypal') {
                return 'paypal';
            }else{
                return 'cash_on_delivary';
            }
    
            return response()->json(['message' => 'Order Place Successfully', 'data'=> $data]);
        }

        return response()->json(['message' => 'Product not found in the cart'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return Order::findOrFail($id);
    }
    public function invoice($id)
    {
        $settings = SiteSetting::first();
        $order = Order::findOrFail($id);
    
        $pdf = MPDf::chunkLoadView('<html-separator/>', 'pdf.order_pdf', ['order' => $order, 'setting' => $settings]);
        return $pdf->download("{$order->code}.pdf");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $order->code = date('Ymd-His') . rand(10, 99);
    }
    public function status(Request $request, $id)
    {
        $data = Order::findOrFail($id)->update([
            'status' => $request->status
        ]);
        if ($data) {
            return response()->json(['message' => 'Data Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
