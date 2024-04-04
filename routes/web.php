<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShippingCostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;

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
    // config
    Route::get('config', function() {

        Artisan::call('optimize');
        return response()->json(['message' => 'optimized']); 

    });
    Route::get('config/clear', function() {

        Artisan::call('optimize:clear');

        return response()->json(['message' => 'optimized cleared']); 

    });
    Route::get('config/update', function() {

   // Execute 'composer update' using exec
   shell_exec('composer update');

   return response()->json(['message' => 'composer updated']); 

    });

});

// Frontend
Route::get('/', [PublicController::class, 'index']);
Route::get('/products/{slug}', [PublicController::class, 'view'])->name('product.view');
Route::get('/shop', [PublicController::class, 'shop']);
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');

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

Route::get('/address', function () {
    return view('address');
});
Route::get('/barcode', function () {
    return view('barcode');
});


// Backend

Route::prefix('admin')->middleware(['auth',  'role:superadmin,admin'])->group(function (){

    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');


    // brands
Route::get('/brands', [BrandController::class, 'index']);
Route::post('/brands', [BrandController::class, 'store']);
Route::put('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
// brands
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

//products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/pagination', [PublicController::class, 'pagination']);
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
Route::get('/orders/invoice/{id}', [OrderController::class, 'invoice']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

Route::get('/site-settings', [SettingController::class, 'index']);
Route::post('/site-settings', [SettingController::class, 'store']);


// user
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/customers', [UserController::class, 'customers']);

// shipping cost
Route::get('/shipping-cost', [ShippingCostController::class, 'index']);
Route::post('/shipping-cost', [ShippingCostController::class, 'store']);
Route::put('/shipping-cost/{id}', [ShippingCostController::class, 'update']);
Route::delete('/shipping-cost/{id}', [ShippingCostController::class, 'destroy']);
// Page
Route::get('/pages', [PageController::class, 'index']);
Route::post('/pages', [PageController::class, 'store']);
Route::put('/pages/{id}', [PageController::class, 'update']);
Route::delete('/pages/{id}', [PageController::class, 'destroy']);
});




//users route
Route::prefix('user')->middleware(['auth'])->group(function (){

Route::get('/profile', function () {
    return view('frontend.user.profile');
});
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login')->with(['message' => 'Data Deleted successfully', 'status' => 'success']);
})->name('user.logout');
});
require __DIR__.'/auth.php';


