<?php

use App\Models\SiteSetting;

if (!function_exists('discountPercentage')) {
    function discountPercentage($price, $discount)
    {
        $discountAmount = $price - $discount;
        return round(($discountAmount / $price) * 100);
    }

}
if(!function_exists('formatCurrency'))
{
    function formatCurrency($amount) 
    {
        $setting = SiteSetting::select('currency_symbol')->first();
        $currencySymbol = $setting->currency_symbol ? : '$'; 

        return $currencySymbol . number_format($amount, 2);
    }
}
if(!function_exists('truncate'))
{
    function truncate($string, $length, $dots = "...") {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }
}
