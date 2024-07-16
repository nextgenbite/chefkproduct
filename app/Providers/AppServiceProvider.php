<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Page;
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
        try{
        $setting = Setting::all()->pluck('svalue', 'skey');
        if ($setting) {
            // config(['cart.tax' => $setting->tax]);
            View::share('settings', $setting);
         }
         $categories =Category::active()->limit(8)->get(['id', 'title','slug', 'icon', 'status']);
        if ($categories) {
            // config(['cart.tax' => $setting->tax]);
            View::share('categories', $categories);
         }
         $pages =Page::active()->limit(8)->get(['id', 'title', 'slug', 'status']);
        if ($pages) {
            // config(['cart.tax' => $setting->tax]);
            View::share('pages', $pages);
         }

         } catch (\Exception $e) {
            return $e->getMessage();
    }
         
    }
}
