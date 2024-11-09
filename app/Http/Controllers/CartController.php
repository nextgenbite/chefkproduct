<?php

namespace App\Http\Controllers;

use App\Models\{Cart, Product,State};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Services\FedexService;


class CartController extends Controller
{
    protected $stripeService;
    protected $fedexService;
    public function __construct( FedexService $fedexService)
    {
        $this->fedexService = $fedexService;
    }
    public function viewCart()
{
    $cart = $this->getUserCart();
    return response()->json($cart->load('items.product'));
}

public function addToCart(Request $request)
{
    try {
    $cart = $this->getUserCart();
    $product_id = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    $cartItem = $cart->items()->firstOrCreate(
        ['product_id' => $product_id],
        ['quantity' => 0, 'price' => Product::find($product_id)->price]
    );
    $cartItem->quantity += $quantity;
    $cartItem->save();

    $this->updateCartTotals($cart);
    return response()->json([
        'status' => 'success',
        'message' => 'Successfully added to cart',
        'data' =>$cart->load('items.product'),
        'sidebar' => view('frontend.partials.sidebar_cart',compact('cart'))->render()
    ]);

} catch (Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}
}



public function increment(Request $request)
{
    try {
    $cart = $this->getUserCart();
    $product_id = $request->input('product_id');

    $cartItem = $cart->items()->where('product_id', $product_id)->first();
    if ($cartItem) {
        $cartItem->increment('quantity');
        $cartItem->save();
        $this->updateCartTotals($cart);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Successfully increment cart',
        'data' =>$cart->load('items.product'),
        'sidebar' => view('frontend.partials.sidebar_cart',compact('cart'))->render()
    ]);

} catch (Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}
}

public function decrement(Request $request)
{
    try{
    $cart = $this->getUserCart();
    $product_id = $request->input('product_id');

    $cartItem = $cart->items()->where('product_id', $product_id)->first();
    if ($cartItem) {
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete();
        }
        $this->updateCartTotals($cart);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Successfully decrement cart',
        'data' =>$cart->load('items.product'),
        'sidebar' => view('frontend.partials.sidebar_cart',compact('cart'))->render()
    ]);

} catch (Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}
}

public function removeFromCart(Request $request)
{
    try{
    $cart = $this->getUserCart();
    $product_id = $request->input('product_id');

    $cart->items()->where('product_id', $product_id)->delete();
    $this->updateCartTotals($cart);

    return response()->json([
        'status' => 'success',
        'message' => 'Successfully decrement cart',
        'data' =>$cart->load('items.product'),
        'sidebar' => view('frontend.partials.sidebar_cart',compact('cart'))->render()
    ]);

} catch (Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}
}

public function updateCartTotals($cart)
{
    $subtotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);
    $weight = $cart->items->sum(fn($item) => $item->product->weight * $item->quantity);
    $tax = $subtotal * ($cart->tax / 100);
    $total = $subtotal + $cart->shipping_cost + $tax - $cart->discount;

    $cart->update(compact('subtotal', 'weight', 'total'));
}

private function getUserCart()
{
    return Cart::firstOrCreate(
        ['guest_id' => session()->getId(), 'user_id' => Auth::id()]
    );
}


public function shipping_cost(Request $request)
{
    $validated = $request->validate([
        'country' => 'required|string',
        'state' => 'required|string',
        'zip' => 'required|string',
    ]);
    $cart = $this->getUserCart();
    $state = State::whereName($request->state)->with('country')->first();
    // return $this->fedexService->authorize();
    // Fake data for the shipper
    $shipper = [
        // 'contact' => [
        //     'personName' => 'John Doe',
        //     'companyName' => 'Example Shipper Inc.',
        //     'phoneNumber' => '1234567890',
        // ],
        'address' => [
            'streetLines' => [' 2266 5TH AVENUE, SUITE 486'],
            'city' => 'New York',
            'stateOrProvinceCode' => 'NY',
            'postalCode' => '10037',
            'countryCode' => 'US',
        ],
    ];

    // Fake data for the recipient
    $recipient = [
          'address' => [
            // 'streetLines' => ['456 Recipient Rd.'],
            'city' => $request->city,
            'stateOrProvinceCode' => $state->code,
            'postalCode' => $request->zip,
            'countryCode' => $state->country->code,
        ],
    ];
    // Prepare the request data based on the selected country and state
    $requestedShipment = [
        "shipper" =>  $shipper,
        "recipient" => $recipient,
        "serviceType" => "FEDEX_GROUND", // Adjust as necessary
        "pickupType" => "DROPOFF_AT_FEDEX_LOCATION",
        "rateRequestType" => [
            "ACCOUNT", // Use this if you are requesting rates associated with your account
            "LIST"     // You can include multiple types by adding them to the array
        ],
        "requestedPackageLineItems" => [
            [
                "weight" => [
                    "units" => "LB",
                    "value" => $cart->weight ?? 0.5, // Adjust weight as needed
                ]
                // Add other package details as required
            ],
        ],
        // Add the rest of your parameters
    ];



    // Call getRate method to retrieve the rates
    try {
        $rates = $this->fedexService->getRateQuotes($requestedShipment);
        // Extract and return the rate as needed
        $rate = isset($rates['output']['rateReplyDetails'][0]) ?
            $rates['output']['rateReplyDetails'][0]['ratedShipmentDetails'][0]['totalNetCharge'] : 0;

            $cart = $this->getUserCart();
        $cart['shipping_cost'] = $rate +3;
        $cart->save();
        // Store the updated cart in the session
        $this->updateCartTotals($cart);

        return response()->json([
            'success' => true,
            'total_price' => formatcurrency($cart['shipping_cost'] +  $cart['total']),
            'shipping_cost' =>   formatcurrency($cart['shipping_cost']),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    
}

function formatFedExRateResponse($apiResponse)
{
    // Extracting necessary details
    $rateDetails = $apiResponse['output']['rateReplyDetails'][0] ?? null;
    $estimatedDeliveryDate = "November 1, 2024 11:59 pm"; // replace with actual dynamic date if available

    if ($rateDetails) {
        $totalNetCharge = $rateDetails['ratedShipmentDetails'][0]['totalNetCharge'] ?? 0;

        // Format the response as desired
        return sprintf("FedEx: $%.2f\nEst. Delivery: %s", $totalNetCharge, $estimatedDeliveryDate);
    } else {
        return "Rate information unavailable.";
    }
}

}
