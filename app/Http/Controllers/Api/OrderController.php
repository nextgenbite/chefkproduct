<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return response()->json($data, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" =>   ["required", "min:3"],
            "phone" =>   ["required", "min:11"],
            "address" =>   ["required"],
            "carts" =>   ["required"],
        ]);
        $data = Order::create([
            "name" =>   $request->name,
            "phone" =>   $request->phone,
            "address" =>   $request->address,
            "total" =>   $request->total,
            "delivery_type" =>   $request->shipping_cost,
            "order_date" =>   date("d/m/Y"),
            "order_month" =>   date("m"),
            "order_year" =>   date("Y"),
        ]);
        foreach($request->carts as $cart){
            $price =$cart['price']-($cart['price']/100) * $cart['discount'];
            OrderItem::create([
                "order_id" =>   $data->id,
                "product_id" =>  $cart['id'],
                "qty" =>   $cart['quantity'],
                "total" =>   $price * $cart['quantity'],
            ]);
        return response()->json( $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
