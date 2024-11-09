<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingCost;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function index()
    {
        $cart = session('cart', []);

        return response()->json($cart, 200);
    }

    function addToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;


        // Retrieve existing cart data from session
        $cart = session('cart', []);
        // Find the product in the cart
         $productIndex = $this->findProductIndex($cart, $productId);

        if ($productIndex !== false) {
            // Update quantity if the product is already in the cart
            $cart['data'][$productIndex]['quantity'] += $quantity;
        } else {
            // Retrieve product details from the database
            $product = Product::find($productId);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            // Add the product to the cart
            $cart['data'][] = [
                'product_id' => $productId,
                'title' => $product->title,
                'thumbnail' => $product->thumbnail,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        // Calculate the total price for the cart
        $totalPrice = $this->calculateTotalPrice($cart);
        $cart['total_price'] = $totalPrice;
        $cart['shipping_cost'] = 0;
        $cart['weight'] = 0;
        $cart['currency_total_price'] = formatCurrency($totalPrice);

        // Store the updated cart in the session
        session(['cart' => $cart]);
        $cart['sidebar'] = view('frontend.partials.sidebar_cart',compact('cart'))->render();
        return response()->json(['message' => 'Item added to the cart', 'data' =>  $cart]);
    }

    private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;

        foreach ($cart['data'] as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        return $totalPrice;
    }

    private function findProductIndex($cart, $productId)
    {
        if (isset($cart['data']) && is_array($cart['data'])) {
            foreach ($cart['data'] as $index => $item) {
                if ($item['product_id'] == $productId) {
                    return $index;
                }
            }
        }

        return false;
    }


    public function increment(Request $request)
    {
        return $this->updateQuantity($request->id, 1);
        
    }
    
    public function decrement(Request $request)
    {
        return $this->updateQuantity($request->id, -1);
    }

    private function updateQuantity($productId, $change)
{
    // Retrieve existing cart data from session
    $cart = session('cart', []);

    // Find the index of the product in the cart
    $productIndex = $this->findProductIndex($cart, $productId);

    if ($productIndex !== false) {
        // Update the quantity of the product in the cart
        $cart['data'][$productIndex]['quantity'] += $change;

        // Ensure the quantity does not go below 1
        if ($cart['data'][$productIndex]['quantity'] < 1) {
            $cart['data'][$productIndex]['quantity'] = 1;
        }

        // Update the total price in the cart
        $cart['total_price'] = $this->calculateTotalPrice($cart);

        // Store the updated cart in the session
        session(['cart' => $cart]);

             // Return the updated cart data
             return [
                'message' => 'Cart updated',
                'quantity' => $cart['data'][$productIndex]['quantity'],
                'item_price' => formatCurrency($cart['data'][$productIndex]['quantity'] * $cart['data'][$productIndex]['price']),
                'subtotal' => formatCurrency($cart['total_price']),
                'shipping_cost' => formatCurrency($cart['shipping_cost']),
                'count' => count($cart['data']),
                'total' => formatCurrency($cart['total_price'] + $cart['shipping_cost']),
                'sidebar' => view('frontend.partials.sidebar_cart',compact('cart'))->render()

            ];
    }

    return response()->json(['message' => 'Product not found in the cart'], 404);
}

public function destroy(Request $request)
{
        // Retrieve existing cart data from session
        $cart = session('cart', []);

        // Find the index of the product in the cart
        $productIndex = $this->findProductIndex($cart, $request->id);
    
        if ($productIndex !== false) {
             // Remove the product from the cart
        array_splice($cart['data'], $productIndex, 1);

        // Update the total price in the cart
        $cart['total_price'] = $this->calculateTotalPrice($cart);
        
        // Store the updated cart in the session
        session(['cart' => $cart]);

        return response()->json(['message' => 'Product removed from the cart', 'total_price' => $cart['total_price']]);
        }
        return response()->json(['message' => 'Product not found in the cart'], 404);
}

public function updateShipping(Request $request)
{
 
    $shippingCost = ShippingCost::findOrFail($request->id);
    $cart = session('cart', []);
    $cart['shipping_cost'] = $shippingCost->cost;

    // Store the updated cart in the session
    session(['cart' => $cart]);

    return response()->json([
        'success' => true,
        'total_price' => formatcurrency($cart['shipping_cost'] +  $cart['total_price']) ,
        'shipping_cost' =>   formatcurrency($cart['shipping_cost']),
    ]);
}
}
