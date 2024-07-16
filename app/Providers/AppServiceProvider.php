<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

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
         // Retrieve data from cache or database
         $settings = Cache::remember('config_data', now()->addHours(24), function () {
            return Setting::get()->pluck('svalue', 'skey');
        });
        if ($settings->isNotEmpty()) {
            // Share settings with views
            View::share('settings', $settings);
        } 
         $categories =Category::active()->limit(8)->get(['id', 'title','slug', 'icon', 'status']);
        if ($categories->isNotEmpty()) {
            // config(['cart.tax' => $setting->tax]);
            View::share('categories', $categories);
         }
         $pages = Page::active()->limit(8)->get(['id', 'title', 'slug', 'status']);;
         if ($pages->isNotEmpty()) {
             View::share('pages', $pages);
         }
        

         } catch (\Exception $e) {
            return $e->getMessage();
    }
         
    }
}
