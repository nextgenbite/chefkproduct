<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShippingCost;
use App\Models\Slider;
use Illuminate\Http\Request;
use Mpdf\Tag\Tr;

class PublicController extends Controller
{

    public function index()
    {
        // $settings =SiteSetting::first();
        // $categories =Category::limit(8)->get(['id', 'title', 'icon']);
        $sliders = Slider::where('status', 1)
            ->whereIn('position', ['main', 'right_top', 'right_bottom'])
            ->with('category:id')
            ->get(['thumbnail', 'category_id', 'title', 'position']);


        $mainBanner = $sliders->where('position', 'main');
        $rightTopBanner = $sliders->where('position', 'right_top')->first();
        $rightBottomBanner = $sliders->firstWhere('position', 'right_bottom');


        // Brand::whereStatus(1)->with('products:id,brand_id')->get();

        $trendProducts =  Product::where(['status' => true, 'trend' => true])->limit(10)->get();

        $newProducts = Product::whereStatus(1)->latest()->limit(10)->get();
        $products = Product::whereStatus(1)->paginate(10);
        return view('frontend.index', compact('mainBanner', 'rightTopBanner', 'rightBottomBanner', 'trendProducts', 'newProducts', 'products'));
    }
    public function shop()
    {
        $products = Product::with('images', 'category', 'brand')->whereStatus(1)->paginate(10);
        $brands = Brand::whereStatus(1)->get(['id', 'title']);

        return view('frontend.shop', compact('products', 'brands'));
    }
    public function view($slug)
    {
        try {
            $product = Product::with('images', 'category:id,title,slug', 'brand:id,title', 'variations:id,product_id,color_id,size_id')->where(['status' => true, 'slug' => $slug])->first();
            $relatedProduct = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->orderBy('id', 'DESC')
                ->limit(10)
                ->get();

            return view('frontend.view', compact('product', 'relatedProduct'));
        } catch (\Exception $exception) {
            abort(404, 'Product Not found');
        }
    }
    public function categoriesView($slug)
    {
        try {
            $data = Category::active()
                ->where('slug', $slug)
                ->with('products')
                ->firstOrFail(); // Use firstOrFail to automatically handle not found scenarios

            return view('frontend.category', compact('data'));
        } catch (\Exception $exception) {
            abort(404, 'Category Not found');
        }
    }

    function checkout()
    {
        $shipping_cost = ShippingCost::all();
        $cart = session('cart');
        // dd(session()->all());
        return view('frontend.checkout', compact('shipping_cost', 'cart'));
    }
    public function navSearch(Request $request)
    {
        $searchTerm = $request->search;

        $result = Product::where('status', 1)
            ->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('sku', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        if ($result->isEmpty()) {
            return response()->json(['html' => '<li class="w-full px-4 py-2 text-center text-gray-500 border-b border-gray-200 rounded-t-lg dark:border-gray-600">No data found</li>']);
        }

        $html = view('frontend.partials.search_result', compact('result'))->render();

        return response()->json(['html' => $html]);
    }
}
