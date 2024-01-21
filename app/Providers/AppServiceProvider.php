<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use View;
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
        $setting = SiteSetting::first();
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
