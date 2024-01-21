<?php

use App\Models\SiteSetting;

if (!function_exists('discountPercentage')) {
    function discountPercentage($price, $discount)
    {
        $discountAmount = $price - $discount;
        return round(($discountAmount / $price) * 100);
    }

    if(!function_exists('formatCurrency'))
    {
        function formatCurrency($amount) 
        {
            $currencySymbol = SiteSetting::where('app_name', 'currency_symbol')->value('currency_symbol');
            $currencySymbol = $currencySymbol ?: '$'; 

            return $currencySymbol . number_format($amount, 2);
        }
    }
}
