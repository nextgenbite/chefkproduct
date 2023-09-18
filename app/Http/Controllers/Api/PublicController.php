<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function pagination()
    {
        $data = Product::paginate(2);
        return response()->json($data, 200);
    }
    public function productQuery(Request $request)
    {
        $query = Product::query();

        if ($request->has('sort')) {
            if ($request->sort === 'price_low_to_high') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_high_to_low') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'latest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->has('brand')) {
            $query->where('brand_id', $request->brand);
        }
        $query->with('images','category' , 'brand');
        $products = $query->paginate(8);

        return response()->json($products);
    }
    public function categories()
    {
        $data = Category::with('products:id,category_id')->get();
        return response()->json($data, 200);
    }
    public function brands()
    {
        $data = Brand::with('products:id,brand_id')->get();
        return response()->json($data, 200);
    }
    public function sliders()
    {
        $data = Slider::with('category')->get();
        return response()->json($data, 200);
    }

    public function ProductDetails($id)
    {
        $product = Product::findOrFail($id);
        $data = Product::with('images', 'category', 'brand')->whereId($id)->first();
        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();
        // return response()->json($relatedProduct);
        return response()->json([
            'data' => $data,
            'relatedProduct' => $relatedProduct,
        ], 200);
    }
    public function categorWiseProduct($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::with('images', 'category', 'brand')->whereCategory_id($id)->paginate(30);
        return view('categories', compact('products', 'category'));
    }
    public function prodcutSearch(Request $request)
    {

        $products = Product::whereStatus(1)->where('product_name', 'LIKE', '%' . $request->q . '%')->orwhere(
            'short_descp_en',
            'LIKE',
            '%' . $request->q . '%'
        )->paginate(20);
        return view('product_search', compact('products'));
    }
    function settings()
    {
        $data = SiteSetting::firstOrFail();
        return response()->json($data, 200);
    }

    public function searchProducts(Request $request)
{
    $query = $request->input('query');

    $products = Product::where('title', 'LIKE', "%$query%")
        ->orWhere('description', 'LIKE', "%$query%")
        ->get();

    return response()->json($products);
}


public function contactEmail(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    // Send the email
    Mail::to('your@email.com')->send(new ContactMail($request->all()));

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Message sent successfully!');
}
}
