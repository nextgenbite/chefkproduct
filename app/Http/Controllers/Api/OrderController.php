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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
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
