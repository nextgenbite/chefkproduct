<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
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

// routes/web.php




// Backend

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


