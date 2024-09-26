<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\{Brand, Category,Order, Page, Product,Slider, Setting, ShippingCost, Size};

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
// use Barryvdh\DomPDF\Facade\Pdf;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{


    public function headCategories()
    {
        $data = Category::whereStatus(1)->select('id','title', 'icon')->get();
        return response()->json($data, 200);
    }
    public function categories()
    {
        $data = Category::whereStatus(1)->with('products:id,category_id')->get();
        return response()->json($data, 200);
    }
    public function SingleCategory($slug)
    {
        $data = Category::whereStatus(1)->where('slug', $slug)->with('products:id,category_id')->first();
        return response()->json($data, 200);
    }
    public function brands()
    {
        $data = Brand::whereStatus(1)->with('products:id,brand_id')->get();
        return response()->json($data, 200);
    }



    public function pagination(Request $request)
    {
        $data = Product::whereStatus(1)->paginate(10);

        return response()->json($data, 200);
    }
    public function productQuery(Request $request)
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

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->has('brand')) {
            $query->where('brand_id', $request->brand);
        }
        $query->with('images','category' , 'brand');
        $products = $query->paginate(10);

        return response()->json($products);
    }

  

    public function sliders()
    {
        $data = Slider::whereStatus(1)->with('category')->get();
        return response()->json($data, 200);
    }

    public function ProductDetails($slug)
    {
        $data = Product::with('images', 'category', 'brand')->where(['status'=>true,'slug'=>$slug])->first();
        $relatedProduct = Product::where('category_id', $data->category_id)
        ->where('id', '!=', $data->id)
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
        return response()->json([
            'data' => $data,
            'relatedProduct' => $relatedProduct,
        ], 200);
    }
    public function categorWiseProduct($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::with('images', 'category', 'brand')->where(['status'=>true,'category_id'=>$id])->paginate(30);
        return response()->json(['products'=>$products, 'category'=>$category]);
    }
    public function trendWiseProduct()
    {
        $products = Product::with('images', 'category', 'brand')->where(['status'=>true,'trend'=>true])->limit(10)->get();
        return response()->json($products);
    }
    public function latestProduct()
    {
        $products = Product::whereStatus(1)->with('images', 'category', 'brand')->latest()->limit(10)->get();
        return response()->json($products);
    }
    public function productSearch(Request $request)
    {

        $products = Product::whereStatus(1)->where('product_name', 'LIKE', '%' . $request->q . '%')->orwhere(
            'short_descp_en',
            'LIKE',
            '%' . $request->q . '%'
        )->paginate(20);
        return response()->json($products);
    }
    function publicSettings()
    {
        $data = SiteSetting::firstOrFail();
        return response()->json($data, 200);
    }
    function settings()
    {
        $data = Cache::remember('config_data', now()->addHours(4), function () {
            return Setting::get()->pluck('svalue', 'skey');
        });
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

public function shippingCost()
{
    $data = ShippingCost::all();
    return response()->json($data, 200);
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
function pages($slug)
{
    return Page::whereTitle($slug)->first();    
}

public function pdf()
{
    $settings = SiteSetting::first();
    $order = Order::first();

    $pdf = MPDF::chunkLoadView('<html-separator/>', 'pdf.order_pdf', ['order' => $order, 'setting' => $settings]);
    return $pdf->stream("{$order->code}.pdf");

    //return $pdf->download('pdf.pdf');
    // return view('pdf.order_pdf', ['order' => $order, 'setting' => $settings]);
    

}
}



