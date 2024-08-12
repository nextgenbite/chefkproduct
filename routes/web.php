<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShippingCostController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User\UserController as UserUserController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
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
Route::get('/', [PublicController::class, 'index'])->name('frontend.home');
Route::get('/categories/{slug}', [PublicController::class, 'categoriesView'])->name('categories.show');
Route::get('/product/{slug}', [PublicController::class, 'view'])->name('product.view');
Route::get('/page/{slug}', [PublicController::class, 'pageView'])->name('page.view');
Route::get('/shop', [PublicController::class, 'shop'])->name('shop');
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/nav/search/', [PublicController::class, 'navSearch'])->name('nav_search');

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

Route::prefix('admin')->middleware(['auth', 'role:superadmin|admin|Admin'])->group(function (){

    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');


    // brands
// Route::get('/brands', [BrandController::class, 'index']);
// Route::post('/brands', [BrandController::class, 'store']);
// Route::put('/brands/{id}', [BrandController::class, 'update']);
// Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
// Route::post('/brands/status', [BrandController::class, 'statusUpdate']);
// Route::delete('/brands/multiple/delete', [BrandController::class, 'multipleDelete'])->name('multiple.brands.delete');
Route::resource('/brands', App\Http\Controllers\BrandController::class);
Route::post('/brands/status', [App\Http\Controllers\BrandController::class, 'statusUpdate']);
Route::delete('/brands/multiple/delete', [App\Http\Controllers\BrandController::class, 'multipleDelete'])->name('multiple.brands.delete');

// categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::post('/categories/status', [CategoryController::class, 'statusUpdate']);
Route::delete('/categories/multiple/delete', [CategoryController::class, 'multipleDelete'])->name('multiple.categories.delete');

//sub categories
Route::resource('/sub-categories', App\Http\Controllers\SubCategoryController::class);
Route::post('/sub-categories/status', [App\Http\Controllers\SubCategoryController::class, 'statusUpdate']);
Route::delete('/sub-categories/multiple/delete', [App\Http\Controllers\SubCategoryController::class, 'multipleDelete'])->name('multiple.sub-categories.delete');
// colors
Route::resource('/colors', App\Http\Controllers\ColorController::class);
Route::post('/colors/status', [App\Http\Controllers\ColorController::class, 'statusUpdate']);
Route::delete('/colors/multiple/delete', [App\Http\Controllers\ColorController::class, 'multipleDelete'])->name('multiple.colors.delete');
// Size
Route::resource('/sizes', App\Http\Controllers\SizeController::class);
Route::post('/sizes/status', [App\Http\Controllers\SizeController::class, 'statusUpdate']);
Route::delete('/sizes/multiple/delete', [App\Http\Controllers\SizeController::class, 'multipleDelete'])->name('multiple.sizes.delete');



//products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/pagination', [PublicController::class, 'pagination']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::post('/products/status', [ProductController::class, 'statusUpdate']);
Route::delete('/products/multiple/delete', [ProductController::class, 'multipleDelete'])->name('multiple.products.delete');


//sliders
// Route::get('/sliders', [SliderController::class, 'index']);
// Route::post('/sliders', [SliderController::class, 'store']);
// Route::put('/sliders/{id}', [SliderController::class, 'update']);
// Route::get('/sliders/{id}', [SliderController::class, 'show']);
// Route::delete('/sliders/{id}', [SliderController::class, 'destroy']);
Route::resource('/sliders', App\Http\Controllers\SliderController::class);
Route::post('/sliders/status', [App\Http\Controllers\SliderController::class, 'statusUpdate']);
Route::delete('/sliders/multiple/delete', [App\Http\Controllers\SliderController::class, 'multipleDelete'])->name('multiple.sliders.delete');

//orders
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::put('/orders/status/{id}', [OrderController::class, 'status']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::get('/orders/invoice/{id}', [OrderController::class, 'invoice']);
Route::get('/orders/invoice/download/{id}', [OrderController::class, 'invoiceDownload']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
Route::post('/orders/status', [OrderController::class, 'statusUpdate']);
Route::delete('/orders/multiple/delete', [OrderController::class, 'multipleDelete'])->name('multiple.orders.delete');



Route::get('/site-settings', [SettingController::class, 'index']);
Route::post('/site-settings', [SettingController::class, 'store']);


// user
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users/status', [OrderController::class, 'statusUpdate']);
Route::delete('/users/multiple/delete', [OrderController::class, 'multipleDelete'])->name('multiple.users.delete');

Route::get('/customers', [UserController::class, 'customers']);
// role
// Route::resource('/roles', App\Http\Controllers\RoleController::class);
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.delete');


// shipping cost
Route::get('/shipping-cost', [ShippingCostController::class, 'index']);
Route::post('/shipping-cost', [ShippingCostController::class, 'store']);
Route::put('/shipping-cost/{id}', [ShippingCostController::class, 'update']);
Route::delete('/shipping-cost/{id}', [ShippingCostController::class, 'destroy']);
// Page
Route::get('/pages', [PageController::class, 'index']);
Route::post('/pages', [PageController::class, 'store']);
Route::get('/pages/{id}', [PageController::class, 'show']);
Route::put('/pages/{id}', [PageController::class, 'update']);
Route::delete('/pages/{id}', [PageController::class, 'destroy']);
Route::post('/pages/status', [PageController::class, 'statusUpdate']);
Route::delete('/pages/multiple/delete', [PageController::class, 'multipleDelete'])->name('multiple.pages.delete');
// test
Route::prefix('/test')->group(function(){

    Route::get('/crud', [TestController::class, 'index']);
});
// Route::post('/pages', [PageController::class, 'store']);
// Route::put('/pages/{id}', [PageController::class, 'update']);
// Route::delete('/pages/{id}', [PageController::class, 'destroy']);
//Settings
Route::resource('/settings', App\Http\Controllers\SettingController::class)->only('index', 'store');

});




//users route
Route::prefix('user')->middleware(['auth'])->group(function (){

Route::get('/dashboard', [App\Http\Controllers\User\UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/orders', [App\Http\Controllers\User\UserController::class, 'orders'])->name('user.orders');
Route::get('/profile', [App\Http\Controllers\User\UserController::class, 'profile'])->name('user.profile');
Route::post('/profile', [App\Http\Controllers\User\UserController::class, 'profileUpdate'])->name('user.profile.update');
Route::get('/password-change', [App\Http\Controllers\User\UserController::class, 'passwordUpdate'])->name('user.password.change');
Route::post('/password-change', [App\Http\Controllers\User\UserController::class, 'passwordUpdateStore'])->name('user.password.update');


Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login')->with(['message' => 'Data Deleted successfully', 'status' => 'success']);
})->name('user.logout');
});
Route::get('/social-login/google/callback', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);
require __DIR__.'/auth.php';



