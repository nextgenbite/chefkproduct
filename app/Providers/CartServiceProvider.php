<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Fetch the cart items
          
            $cartItems =   Cart::firstOrCreate(
                ['guest_id' => session()->getId(), 'user_id' => auth()->id()]
            );

            // Share the cart items globally
            $view->with('cartItems', $cartItems);
        });
    }
}
