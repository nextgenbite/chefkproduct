<?php

namespace App\Http\Controllers;

use App\Models\{Brand, Category, Color, Country, Page, Product, Slider, ShippingCost, Size};

use Illuminate\Http\Request;
// use Mpdf\Tag\Tr;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{

    public function index()
    {
        // $settings =SiteSetting::first();
        // $categories =Category::limit(8)->get(['id', 'title', 'icon']);
        $sliders = Slider::active()
            ->whereIn('position', ['main', 'right_top', 'right_bottom'])
            ->with('category:id')
            ->latest()
            ->get(['thumbnail', 'category_id', 'title', 'position']);


        $mainBanner = $sliders->where('position', 'main');
        $rightTopBanner = $sliders->where('position', 'right_top')->first();
        $rightBottomBanner = $sliders->firstWhere('position', 'right_bottom');


        // Brand::whereStatus(1)->with('products:id,brand_id')->get();
        // Fetching recent, trend, and top products in a single query
        $productsQuery = Product::query()->active();
        $trendProducts =  $productsQuery->where('trend', 1)->limit(5)->get();

        $newProducts = $productsQuery->latest()->limit(5)->get();
        $products = $productsQuery->paginate(5);
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
                url('/' . $slug),
                $product->title,
                ['class' => 'text-primary-light hover:animate-pulse hover:text-primary-800 h-8 w-8 mx-2 rounded-full border border-gray-300 flex items-center justify-center', 'rel' => 'nofollow noopener noreferrer']
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
            throw $exception;
        }
    }
    public function categoriesView($slug)
    {
        try {
            $data = Category::active()
                ->with(['products' => function ($query) {
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
        $countries = Country::with('states')->get();
        $cart = session('cart');
        // dd(session()->all());
        return view('frontend.checkout', compact('countries', 'shipping_cost', 'cart'));
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

    public function contactStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send the email
        Mail::to('iliusrahman@gmail.com')->send(new ContactMail($request->all()));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function partnership()
    {
        $title = 'BE A PARTNER WITH US';
        $countries = Country::with('states')->get();

        return view('frontend.partnership', compact('title', 'countries'));
    }
    public function partnershipStore(Request $request)
    {
        $request->validate([
            'state ' => 'required',
        ]);
        $data = $request->all();


        return view('emails.be_partner', compact('data'));
    }
    public function about()
    {
        $title = 'About Us';


        return view('frontend.about_us', compact('title'));
    }
    public function stores()
    {
        $title = 'find our products in these stores';
        $data = collect([
            [
                'title' => 'IN BROOKLYN',
                'items' => [
                    ['title' => 'GALA FOODS', 'location' => '492 ST. MARKS AVE, BROOKLYN NY 11238', 'phone' => '718-789-2115'],
                    ['title' => 'Ideal Food', 'location' => '1871 ROCKAWAY PKWY, BROOKLYN NY 11236', 'phone' => '718-531-0205'],
                    ['title' => 'IDEAL FOOD BASKE', 'location' => '840 EAST NEW YORK AVE BROOKLYN NY 1203', 'phone' => '718-221-0113'],
                    ['title' => 'C TOWN', 'location' => '597 E 16TH ST, BROOKLYN NY 11226', 'phone' => '718-434-2712 (JERRY)'],
					['title' => 'KEY FOOD', 'location' => '786 FLATBUSH AVE, BROOKLYN,NY 11226', 'phone' => '718-462-5890/718 687-7428 (CELL SAM)'],
					['title' => 'FOOD WORLD', 'location' => '935 E 107TH ST BROOKLYN NY 11236', 'phone' => '(CARLOS)'],
					['title' => 'ASSOCIATED**', 'location' => '650 FLATBUSH AVE, BROOKLYN NY 11225', 'phone' => ''],
					['title' => 'KEY FOOD $', 'location' => '5101 AVE N BROOKLYN NY 1120', 'phone' => ''],
					['title' => 'CITY FRESH/ASSOC', 'location' => '1380 PENNSYLVANIA AVE, BROOKLYN NY 11239', 'phone' => ' 718642-1608 (JUNIOR)'],
					['title' => 'FOOD UNIVERSE', 'location' => '1720 ATLANTIC AVE BROOKLYN NY 11213', 'phone' => ' 718-363-0281'],
					['title' => 'FINE FARE $', 'location' => '675 LINCOLN AVE, BROOKLYN NY 11208', 'phone' => ''],
					['title' => 'GITTO FARMERS MARKET', 'location' => '4141 LACONIA AVE BRONX NY 10466', 'phone' => ''],
					['title' => 'GITTO FARMERS MARKET 3', 'location' => 'N MARKET ST, BROOKLYN NY 11236', 'phone' => ' 718-209-4587'],
					['title' => 'GOOD FOOD FOR LESS', 'location' => '1115 PENNSYLVANIA AVE, BROOKLYN NY 11207', 'phone' => ' 718-345-2873 (RAY)'],
					['title' => 'ASSOCIATED SUPERMARKET', 'location' => '333 SENECA AVE, FLUSHING NY 11385', 'phone' => ' (JUAN JOSE)'],
					['title' => 'IDEAL FOOD BASKET', 'location' => '1488 PITKIN AVE BROOKLYN NY 1120', 'phone' => ' 718-385-3265 (CABA, HERIBERTO)'],
					['title' => 'CARIBBEAN SUPERMARKET', 'location' => '741 Utica Ave, Brooklyn NY 11203', 'phone' => ' 929-234-3111 (Victor)'],
                ]
                ],
            [
                'title' => 'IN QUEENS',
                'items' => [
                    ['title' => 'KEY FOOD', 'location' => '225-08 Merrick Blvd, Laurelton NY Al/', 'phone' => ''],
                    ['title' => 'C-TOWN **', 'location' => '142-36 FOCH BLVD, JAMAICA NY. 11436', 'phone' => '718-529-8040'],
                    ['title' => 'GIANT FARM', 'location' => '211 -14 Hillside Ave Jamaica NY 11427', 'phone' => ''],
                    ['title' => 'KEY FOOD ** *', 'location' => '935 ROSEDALE, RD VALLEY STREAM NY MGR RAFFY', 'phone' => '516-564-9935'],
					['title' => 'FOOD WORLD', 'location' => '500 MERRICK RD VALLEY STREAM NY', 'phone' => ''],
					['title' => 'IDEAL FOOD BASKET', 'location' => 'ROCHDALE VILAGE NY 11434 MGR GERARDO Y CARLOS', 'phone' => '718-276-4100'],
					['title' => 'FINE FARE $', 'location' => '199-11 Hollis Ave, Jamaica NY 11412- Sahid', 'phone' => ''],
					['title' => 'C TOWN $C', 'location' => '110-14 Farmers Blvd', 'phone' => ''],
					['title' => 'FARM COUNTRY', 'location' => 'MERRICK BLVD. LAURELTON NY 11413', 'phone' => ' 347-479-3946'],
					['title' => 'F.A.C.A. R.O.C. THE ROC', 'location' => '132-05 MERRICK BLVD, QUEENS NY 11434', 'phone' => '718-906- 8920 (Sophia/keisha)'],
					['title' => 'FOOD WORLD', 'location' => '119-14 SUTPHIN BLVD JAMAICA NY 11434', 'phone' => '718- 322-5641'],
					['title' => 'FINE FARE', 'location' => '89-45 163RD ST, JAMAICA, NY 11432', 'phone' => ''],
					['title' => 'GREEN FARM MARKET', 'location' => '89-01 165 ST, QUEENS NY 11432', 'phone' => ''],
					['title' => 'VP RECORDS', 'location' => '170-21 JAMAICA, JAMAICA NY 11432', 'phone' => ''],
					['title' => 'MANAN SUPERMARKET $', 'location' => '166-11 HILLSIDE AVE, QUEENS NY 11432', 'phone' => ''],
					['title' => 'CTOWN $', 'location' => '195-09 JAMAICA AVE QUEENS NY 11423 St. Albans NY 11412- Jr', 'phone' => ''],
                ]
                ],
			[
			 'title' => 'IN FAR ROCKAWAY',
                'items' => [
                    ['title' => 'SHOP FAIR', 'location' => '245 BEACH 20TH ST. FAR ROCKAWAY, NY 11691', 'phone' => '718-327-9820'],
                    ['title' => 'GENESSIS DELI', 'location' => '25-11 FAR ROCKAWAY BLVD, FAR ROCKAWAY NY 11691', 'phone' => '347-564-1422 (DENNIS)'],
                    ['title' => 'GOODY’S RESTAURANT', 'location' => '7018 AMSTEL BLVD, ARVERNE NY 11692','tel'=> '718-318-9616,', 'phone' => '718-406-2866 (GARRY)'],
                    ['title' => 'AAA DELI', 'location' => '33 BEACH CHANNEL DR ARVERNE, NY 11692', 'phone' => ''],
					['title' => 'KEY FOOD', 'location' => '2020 NEW HAVEN AVE FAR ROCKAWAY NY 11691', 'phone' => '718-337-2740']
			    ]
                ],
			[
			 'title' => 'IN BRONX',
                'items' => [
                    ['title' => 'SANO HALAL FOOD CORP $', 'location' => '3982 WHITE PLAINS RD BRONX NY 10466', 'phone' => '718- 324-0791'],
                    ['title' => 'KEY FOOD “CORPERATE”', 'location' => '689 E 232ND ST BRONX NY 10466', 'phone' => ''],
                    ['title' => 'BEST M & M INC $', 'location' => '4370 WHITE PLAINS RD BRONX YN 10466', 'phone' => '718324-5572 (TONY)'],
                    ['title' => 'METS SUPERMARKET $', 'location' => '4401 WHITE PLAINS RD, BRONX NY 10470', 'phone' => '347- 699-1566 (NICOLAS)'],
					['title' => 'FINE FARE $', 'location' => '4725 WHITE PLAINS RD, BRONX NY 10470', 'phone' => '718-881-8600 (EDDIE)'],
					['title' => 'CHERRY VALLEY $', 'location' => '801 E Gun Hill Rd Bronx NY 10466', 'phone' => ''],
					['title' => 'CHERRY VALLEY $', 'location' => '2870 webster Ave Bronx NY 10458', 'phone' => ''],
					['title' => 'FOOD UNIVERSE $', 'location' => '1334 LOUIS NINE BLVD BRONX NY 10459', 'phone' => '718- 617-7160'],
					['title' => 'C TOWN', 'location' => '309 BURNSIDE AVE, BRONX NY 10457', 'phone' => ' 718938-6921 (ABEL)'],
					['title' => 'BIG APPLE HEALTH STORE *', 'location' => 'WHITE PLAINS ROAD BRONX NY 104', 'phone' => '718-654-4731 (RAM)'],
					['title' => 'PALM TREE $', 'location' => '3717 BOSTON RD BRONX NY 10466', 'phone' => '718-231-6323'],
					['title' => 'SY GRACE', 'location' => '4018 B BOSTON RD BRONX NY 10475', 'phone' => '718-671-5544'],
					['title' => 'AFRICAN MARKET', 'location' => '1345 WEBSTER AVE BRONX NY 10456', 'phone' => '929-228-7141 (MO)'],
					['title' => 'FOOD FEST DEPOT', 'location' => '500 E 132ND ST, BRONX NY 10454', 'phone' => '718-993-2020 (GIGI)'],
					['title' => 'PIONEER SUPERMARKET $', 'location' => '256 ST ANN’S AVE BRONX NY 10454', 'phone' => ''],
					['title' => 'PIONEER SUPERMARKET $', 'location' => '250 WILLIS AVE BRONX NY 10454', 'phone' => ''],
					['title' => 'FOOD UNIVERSE $', 'location' => '60 W 183RD ST, BRONX NY 10453', 'phone' => ''],
					['title' => 'MADINA TRADING $', 'location' => '270 E 165TH ST, BRONX NY 10456', 'phone' => '929-263-1450'],
					['title' => 'KADIJA SUPERMARKET $', 'location' => '1034 MORRIS AVE BRONX NY 10456', 'phone' => '718-450-3077'],
					['title' => 'ROYAL GROUP MKT CORP', 'location' => '294 E 166TH ST BRONX NY 10456', 'phone' => '347-880-8435 (Adji)'],
					['title' => 'ASSOCIATED SUPERMARKET', 'location' => '724 E 161 ST BRONX NY 10456', 'phone' => '718-715-6616 (FRANK)'],
					['title' => 'CHANG LI**', 'location' => '2079 BENEDICT AVE BRONX NY 10462 JOSE', 'phone' => ''],
					['title' => 'BROTHERS PRODUCE', 'location' => '1154 GUNHILL RD BRONX NY 10469', 'phone' => '718-547-3332 (JENNY/Ezra)'],
					['title' => 'FOOD TOWN', 'location' => '4332 White Plain Rd, Bronx NY', 'phone' => '718-682-7438 (Victor/Eddie)'],
					['title' => 'JAMAICA RYTHEM', 'location' => '3963 BRONXWOOD AVE, BRONX NY 10466', 'phone' => ''],
					['title' => 'FOOD TOWN', 'location' => '3471 BOSTON RD BRONX NY', 'phone' => '718-682-7301 (Fausto)'],
					['title' => 'C MARKET FOOD TOWN', 'location' => '3734 WHITE PLAINS RD BRONX NY 10467', 'phone' => '718- 519-9600 (JONATHAN)'],
					['title' => 'FINE FARE', 'location' => '3550 WHITE PLAINS RD BRONX NY 10467', 'phone' => '347- 364-5640 (BASSILLIO)'],
					['title' => 'FINE FARE', 'location' => 'FINE FARE', 'phone' => ' 718 881-8600 (JOSE)'],
					['title' => 'CARIBBEAN SUPERMARKET', 'location' => '222 W 1ST ST MT VERNON NY 10550', 'phone' => '914-665-3737 (BOBBY)'],
					['title' => 'FINE FARE', 'location' => '1199 E 233RD ST BRONX NY 10466', 'phone' => '347-449-6259 (Richie)'],
					['title' => 'FINE FARE', 'location' => '2556 BOSTON RD BRONX', 'phone' => ''],
					['title' => 'FINE FARE', 'location' => '1199 E 233RD ST BRONX NY 10466', 'phone' => '347-449-6259 (Richie)'],
					['title' => 'FINE FARE', 'location' => '2556 BOSTON RD BRONX', 'phone' => ''],
			    ]
                ],
			[
			 'title' => 'IN LONG ISLAND',
                'items' => [
                    ['title' => 'FRUIT TREE', 'location' => '1197 GRAND AVE, BADWIN NY 11510','tel' => '516-486-7444', 'phone' => '347-587-9555 (JOE)', 'phone2' => '917-325-5756'],
                    ['title' => 'COMPARE SUPERMARKET $', 'location' => '1551 STRAIGHT PATH, WYANDANCH NY 11798', 'phone' => ''],
                    ['title' => 'GEORGE’S BAKERY', 'location' => '1197 GRAND AVE, BALDWIN NY 11510', 'phone' => '516-489-8611 (BRIAN /KAREN)'],
                    ['title' => 'C TOWN', 'location' => '565 UNIONDALE AVE, UNIONDALE NY 11553', 'phone' => '516-559-8630 (Rafael)','phone_2' => '516-721-5763(TEO)'],
					['title' => 'KEY FOOD $', 'location' => 'CENTRAL AVE, VALLEY STREAM NY TEL RAYMOND', 'phone' => ''],
					['title' => 'KEY FOOD $', 'location' => '108-30 MERRICK BLVD JAMAICA NY', 'phone' => '718-206- 1323 (Miguel/Wilson)'],
					['title' => 'VILLAGE PLZ COMPARE $', 'location' => '29 VILLAGE RD, ELMONT NY 11003 CARMEN', 'phone' => ''],
					['title' => 'V & C SUPERMARKET $', 'location' => '12 FRANKLIN ST HEMPSTEAD NY 11550', 'phone' => '516-387-5566 ', 'phone' => '917-415-3890 (Allan) '],
					['title' => 'SAM’S MARKET PL', 'location' => '225 HEMPSTEAD TURNPIKE SW HEMPSTEAD NY 11552', 'phone' => ' 516-858-0054 (PATRICE)'],
					['title' => 'JNJ CARIB MARKET $', 'location' => '33 MAIN ST, HEMPSTEAD, NY 11550', 'phone' => '516-280-7860 (NADINE)'],
				]
            ],
			[
			 'title' => 'RESTAURANTS',
                'items' => [
                    ['title' => 'GOLDEN CREST REST $', 'location' => '830 Jerusalem Ave Uniondale NY Ken','phone' => ''],
                    ['title' => 'ST. BEST REST $', 'location' => '4466 BAYCHESTER AVE BRONX NY 10466', 'phone' => '347- 699-1639 (SANDRA)'],
                    ['title' => 'Dumpling Cove REST $', 'location' => 'Baychester Ave, Bronx NY', 'phone' => ''],
                    ['title' => 'KING BARKA REST $', 'location' => '301 W 135TH ST, NY NY 10030', 'phone' => ''],
					['title' => 'REGGAE SUN DELIGHTS', 'location' => '$227W 145TH ST, NY NY10039', 'phone' => ' 347-472-6265'],
					['title' => 'CHAMPION BAKERY $', 'location' => '3966 White Plains Rd, Bronx NY 10466', 'phone' => ' 718-882-1556 (Ms. Gloria)'],
					['title' => '14 PARISH RESTAURANT', 'location' => '98 ANDERSON ST, HACKENSACK NJ 07601', 'phone' => ' 201-397-7918 (ROMEO)'],
					['title' => 'GOLDEN KRUST CARIB REST', 'location' => '303 MAIN ST. E. ORANGE NJ 07050.', 'phone' => ' 973-672-7080 (LOY)'],
					['title' => 'CONSTANT SPRING CARIB', 'location' => '1344 GUN HILL RD BRONX NY', 'phone' => ' 347-499-8796 (HECTOR)'],
					['title' => 'ONE DROP REST $', 'location' => '284 N MAIN ST, FREEPORT NY 11520', 'phone' => '516 623-7890 / Ms. Clarke (Corina)'],
					['title' => 'BUFF PATTY REST', 'location' => '376 MYRTLE AVE, BROOKLYN NY 11205', 'phone' => ' 718-855-3266'],
				]
                ],
			[
			 'title' => 'IN NEW JERSEY',
                'items' => [
                    ['title' => 'ORANGE FARMERS MARKET INC *', 'location' => '502 MAIN ST, E. ORANGE NJ 07050','phone' => '862-438-8812 (SUSAN)'],
                    ['title' => 'JOE’S FRUIT MARKET *', 'location' => '201 MAIN ST. E. ORANGE NJ 07050', 'phone' => '973-674-8972 (JOE/ROBERTO)'],
                    ['title' => 'EXTRA SUPERMARKET', 'location' => '563 CENTRAL AVE E. ORANGE NJ 07018', 'phone' => '973- 580-7166 (BERNARD)'],
                    ['title' => 'NEW GIANT MARKET', 'location' => '324 Main St Hackensack NJ 0701', 'phone' => '']
				]
                ],
			[
			 'title' => 'IN COLOR CODED',
                'items' => [
                    ['title' => 'KEY FOOD', 'location' => '225-08 Merrick Blvd, Laurelton NY Al/','phone' => ''],
                    ['title' => 'C-TOWN **', 'location' => '142-36 FOCH BLVD, JAMAICA NY. 11436 718-529-8040', 'phone' => ''],
                    ['title' => 'GIANT FARM', 'location' => '211 -14 Hillside Ave Jamaica NY 11427', 'phone' => ''],
					['title' => 'KEY FOOD ** *', 'location' => '935 ROSEDALE, RD VALLEY STREAM NY MGR RAFFY', 'phone' => '516-564-9935'],
					['title' => 'FOOD WORLD', 'location' => '500 MERRICK RD VALLEY STREAM NY', 'phone' => ''],
					['title' => 'IDEAL FOOD BASKET', 'location' => 'ROCHDALE VILAGE NY 11434 MGR GERARDO Y CARLOS', 'phone' => '718-276-4100'],
					['title' => 'FINE FARE $', 'location' => '199-11 Hollis Ave, Jamaica NY 11412- Sahid', 'phone' => ''],
					['title' => 'C TOWN $C', 'location' => '110-14 Farmers Blvd', 'phone' => ''],
				]
                ],
			[
			 'title' => 'IN CONNECTICUT',
                'items' => [
                    ['title' => 'CHERY VALLEY', 'location' => '155 TThomaston Ave, Waterbury CT 06702','phone' => '203-754-5700'],
                    ['title' => 'Js OCEAN FISH MARKET', 'location' => '744 W Main St, Waterbury CT 06702', 'phone' => '203-318-6153 (Sunny)'],
                    ['title' => 'FOOD UNIVERSE', 'location' => '3942 White Plains Rd, 2nd Floor Bronx 10466', 'phone' => '718-231-0981'],
					['title' => 'SHOP FAIR', 'location' => '3917 White Plains Rd, Bronx NY 10467', 'phone' => ''],
					['title' => 'FOOD BAZAAR', 'location' => '500 Sylan Avenue Bridgeport Ct', 'phone' => ''],
				]
                ],
			[
			 'title' => 'IN MANHATTAN',
                'items' => [
                    ['title' => 'FINE FARE $', 'location' => '37 MALCOLM X BLVD, NY NY 10026','phone' => '212-222-2211'],
                    ['title' => 'FINE FARE $', 'location' => '136 LENOX AVE NY NY 10026', 'phone' => '212-828-9951'],
                    ['title' => 'C TOWN', 'location' => '238 W 116 TH ST NY NY 10026', 'phone' => '212-222-1379'],
					['title' => 'PIONEER $', 'location' => '380 LENOX AVE NY NY10027', 'phone' => '212-427-4615'],
					['title' => 'FOOD DYNASTY', 'location' => '444 LENOX AVE NY NY10030 JULIO $', 'phone' => ''],
					['title' => 'FINE FARE $', 'location' => '24 W 135TH ST NY NY10037', 'phone' => ''],
					['title' => '537 DELI', 'location' => '537 Malcolm X Blvd New York NY 10037', 'phone' => ''],
					['title' => '145 FOOD PLAZA', 'location' => '86 W 145TH ST NEW YORK NY 10037', 'phone' => ''],
					['title' => 'FOOD EMPORIUM $', 'location' => '2341 7TH AVE NY NY10039 Raymond', 'phone' => ' 646-453-3361'],
					['title' => 'FOOD TOWN', 'location' => '2463 8TH AVE NY NY10027', 'phone' => '347-695-8418'],
					['title' => 'CITY FRESH MARKET', 'location' => '125 E 116TH ST NY NY, 10029', 'phone' => ''],
					['title' => 'SHOP FAIR', 'location' => '160 E 110TH ST NY NY 10029', 'phone' => ''],
					['title' => 'KEY FOOD', 'location' => '1769 2ND AVE NY, NY 10029', 'phone' => ''],
					['title' => 'SHOP FAIR', 'location' => '2110 ADAM CLAYTON POWEL JR BLVD NY NY 10027', 'phone' => '646-476-5799'],
					]
			]
        ]);
    
        return view('frontend.stores', compact('title', 'data'));
    }
    

    // public function shop()
    // {
    //     $products = Product::with('images', 'category', 'brand')->whereStatus(1)->paginate(10);
    //     $brands = Brand::whereStatus(1)->get(['id', 'title']);

    //     return view('frontend.shop', compact('products', 'brands'));
    // }
}
