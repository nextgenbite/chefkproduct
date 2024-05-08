<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting = Setting::all()->pluck('svalue', 'skey');
        if ($setting) {
            // config(['cart.tax' => $setting->tax]);
            View::share('settings', $setting);
         }
         $categories =Category::limit(8)->get(['id', 'title','slug', 'icon']);
        if ($categories) {
            // config(['cart.tax' => $setting->tax]);
            View::share('categories', $categories);
         }

         
    }
}
