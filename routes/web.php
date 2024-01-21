<?php

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

// Backend

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


