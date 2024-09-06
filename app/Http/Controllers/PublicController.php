<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Page;
use App\Models\Product;
use App\Models\ShippingCost;
use App\Models\Size;
use App\Models\Slider;
use Illuminate\Http\Request;
// use Mpdf\Tag\Tr;

class PublicController extends Controller
{

    public function index()
    {
        // $settings =SiteSetting::first();
        // $categories =Category::limit(8)->get(['id', 'title', 'icon']);
        $sliders = Slider::active()
            ->whereIn('position', ['main', 'right_top', 'right_bottom'])
            ->with('category:id')
            ->get(['thumbnail', 'category_id', 'title', 'position']);


        $mainBanner = $sliders->where('position', 'main');
        $rightTopBanner = $sliders->where('position', 'right_top')->first();
        $rightBottomBanner = $sliders->firstWhere('position', 'right_bottom');


        // Brand::whereStatus(1)->with('products:id,brand_id')->get();
        // Fetching recent, trend, and top products in a single query
        $productsQuery = Product::query()->active();
        $trendProducts =  $productsQuery->where('trend', 1)->limit(10)->get();

        $newProducts = $productsQuery->latest()->limit(10)->get();
        $products = $productsQuery->paginate(10);
        return view('frontend.index', compact('mainBanner', 'rightTopBanner', 'rightBottomBanner', 'trendProducts', 'newProducts', 'products'));
    }

    public function view($slug)
    {
        try {
            $product = Product::with('images', 'category:id,title,slug', 'brand:id,title', 'variations:id,product_id,color_id,size_id')->where(['status' => true, 'slug' => $slug])->firstOrFail();
            $relatedProduct = Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->orderBy('id', 'DESC')
                ->limit(10)
                ->get();
                $shareButtons = \Share::page(
                    url('/'.$slug),
                    $product->title,['class' => 'text-primary-light hover:animate-pulse hover:text-primary-800 h-8 w-8 mx-2 rounded-full border border-gray-300 flex items-center justify-center', 'rel' => 'nofollow noopener noreferrer']
                )
                ->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp()        
                ->reddit();

            return view('frontend.view', compact('product', 'relatedProduct', 'shareButtons'));
        } catch (\Exception $exception) {
            abort(404, 'Product Not found');
        }
    }
    public function categoriesView($slug)
    {
        try {
            $data = Category::active()
            ->with(['products'=> function($query){
                $query->paginate(15);
            }])
                ->where('slug', $slug)
                ->firstOrFail(); // Use firstOrFail to automatically handle not found scenarios

            return view('frontend.category', compact('data'));
        } catch (\Exception $exception) {
            abort(404, 'Category Not found');
        }
    }
    public function pageView($slug)
    {
        try {
            $data = Page::active()
                ->where('slug', $slug)
                ->firstOrFail(); // Use firstOrFail to automatically handle not found scenarios

            return view('frontend.page', compact('data'));
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

    //filter shop page
    public function shop(Request $request)
    {
        $query = Product::query();

        $query->whereStatus(1);

        if ($request->has('sort')) {
            if ($request->sort === 'price_low_to_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high_to_low') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->whereIn('category_id', $request->category);
        }
        if ($request->has('brand')) {
            $query->where('brand_id', $request->brand);
        }
        $query->with('images', 'category', 'brand');
        // $products = $query->paginate(10);
        $products = $query->paginate(10);
        $brands = Brand::whereStatus(1)->get(['id', 'title']);
        $colors = Color::get(['id', 'name', 'code']);
        $size = Size::get(['id', 'name']);
        if ($request->ajax()) {

            $html = view('frontend.partials.product_grid_row', compact('products'))->render();

            return response()->json(['html' => $html]);
        }

        return view('frontend.shop', compact('products', 'brands', 'size', 'colors'));
    }
    public function contact()
    {


        return view('frontend.contact');
    }
    // public function shop()
    // {
    //     $products = Product::with('images', 'category', 'brand')->whereStatus(1)->paginate(10);
    //     $brands = Brand::whereStatus(1)->get(['id', 'title']);

    //     return view('frontend.shop', compact('products', 'brands'));
    // }
}
