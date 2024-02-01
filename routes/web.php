<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Tasks
Route::prefix('tasks')->group(function() {

    // Queue
    Route::get('queue', function() {

        Artisan::call('queue:work', ['--stop-when-empty' => true, '--force' => true]);

    });

    // Schedule
    Route::get('schedule', function() {

        Artisan::call('schedule:run');

    });

});

// Frontend
Route::get('/', [PublicController::class, 'index']);
Route::get('/products/{slug}', [PublicController::class, 'view']);
Route::get('/shop', [PublicController::class, 'shop']);
Route::get('/checkout', [PublicController::class, 'checkout']);

// Cart
Route::post('/cart/add', [CartController::class, 'addToCart']);
// Route::patch('/cart/update/', [CartController::class, 'cartUpdated']);
Route::post('/cart/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
Route::post('/cart/remove', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/update-shipping', [CartController::class, 'updateShipping'])->name('cart.update-shipping');

// Order
Route::post('/place-order', [OrderController::class, 'store']);


// Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
// routes/web.php




// Backend

Route::prefix('admin')->middleware(['auth'])->group(function (){

    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
});

require __DIR__.'/auth.php';


