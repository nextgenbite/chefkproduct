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
         $settings = Cache::remember('config_data', now()->addHours(4), function () {
            return Setting::get()->pluck('svalue', 'skey');
        });
        if ($settings->isNotEmpty()) {
            // Share settings with views
            View::share('settings', $settings);
        } 
        $this->cacheAndShare('categories', Category::class, 4, ['id', 'title', 'slug', 'icon', 'status']);
        $this->cacheAndShare('pages', Page::class, 4, ['id', 'title', 'slug', 'status']);

         } catch (\Exception $e) {
            return $e->getMessage();
    }
         
    }
    protected function cacheAndShare($key, $model, $hours, $fields) {
        $data = Cache::remember($key, now()->addHours($hours), function () use ($model, $fields) {
            return $model::active()->limit(8)->get($fields);
        });
    
        if ($data->isNotEmpty()) {
            View::share($key, $data);
        }
    }
}
