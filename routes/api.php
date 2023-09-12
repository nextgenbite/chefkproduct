<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PublicController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group( function () {

    // Authentication routes
    Route::post('/logout', [AuthController::class, 'logout']);

});

// brands
Route::get('/brands', [BrandController::class, 'index']);
Route::post('/brands', [BrandController::class, 'store']);
Route::put('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
// brands
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

//products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/pagination', [ProductController::class, 'pagination']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

//sliders
Route::get('/sliders', [SliderController::class, 'index']);
Route::post('/sliders', [SliderController::class, 'store']);
Route::put('/sliders/{id}', [SliderController::class, 'update']);
Route::get('/sliders/{id}', [SliderController::class, 'show']);
Route::delete('/sliders/{id}', [SliderController::class, 'destroy']);
//orders
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::put('/orders/status/{id}', [OrderController::class, 'status']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

Route::get('/site-settings', [SettingController::class, 'index']);
Route::post('/site-settings', [SettingController::class, 'store']);

Route::get('public/sliders', [PublicController::class, 'sliders']);
Route::get('public/categories', [PublicController::class, 'categories']);
Route::get('public/brands', [PublicController::class, 'brands']);
Route::get('public/products', [PublicController::class, 'productQuery']);
Route::get('public/details/{id}', [PublicController::class, 'ProductDetails']);
Route::get('/search/products', [PublicController::class, 'searchProducts']);
Route::get('public/settings', [PublicController::class, 'settings']);
Route::post('/order', [OrderController::class, 'store']);


