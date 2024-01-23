<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ShippingCost;
use App\Models\Slider;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PublicController extends Controller
{
    
    public function index(){
        // $settings =SiteSetting::first();
        // $categories =Category::limit(8)->get(['id', 'title', 'icon']);
        $sliders =Slider::whereStatus(1)->with('category')->get();

        $mainBanner =$sliders->where('position', 'main');
        $rightTopBanner =$sliders->where('position', 'right_top')->first();
        $rightBottomBanner =$sliders->where('position', 'right_bottom')->first();
        Brand::whereStatus(1)->with('products:id,brand_id')->get();

        $trendProducts =  Product::with('images', 'category', 'brand')->where(['status'=>true,'trend'=>true])->limit(10)->get();

        $newProducts = Product::whereStatus(1)->with('images', 'category', 'brand')->latest()->limit(10)->get();
        $products = Product::whereStatus(1)->paginate(10);
        return view('frontend.index', compact('mainBanner','rightTopBanner', 'rightBottomBanner', 'trendProducts','newProducts', 'products'));
    }
    public function shop(){
        $products = Product::with('images', 'category', 'brand')->whereStatus(1)->paginate(10);
        $brands= Brand::whereStatus(1)->get(['id', 'title']);

        return view('frontend.shop', compact('products', 'brands'));
    }
    public function view($slug){
        $product = Product::with('images', 'category', 'brand')->where(['status'=>true,'slug'=>$slug])->first();
        $relatedProduct = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();

        return view('frontend.view',compact('product','relatedProduct' ));
    }
    function checkout()
    {
        $shipping_cost = ShippingCost::all();
        $cart = session('cart');
        // dd(session()->all());
        return view('frontend.checkout', compact('shipping_cost', 'cart'));    
    }
}
