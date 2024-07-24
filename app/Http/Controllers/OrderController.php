<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\User;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    use  BaseTrait;
    private $title = ['Order', 'orders'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Order::latest()->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })
                ->addColumn('status', function ($row) {
                    return $this->CrudStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['checkbox',  'action', 'status'])
                ->make(true);
        }
        $columns = [
            [
                'data' => 'checkbox',
                'name' => 'checkbox',
                'title' =>  '<input type="checkbox" class="rounded-full" id="selectAll" />',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'order_date', 'name' => 'order_date', 'title' => 'Date', 'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'name', 'name' => 'name', 'title' => 'Name',
                'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total'],
            ['data' => 'payment_method', 'name' => 'payment_method', 'title' => 'Payment Method'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status'],
            [
                'data' => 'status', 'name' => 'status', 'title' => 'Status',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'action', 'name' => 'action', 'title' => 'Action',
                'orderable' => false,
                'searchable' => false
            ],
            // [ 'data'=> 'user.name', 'name'=> 'user.name' ],
            // Add more columns as needed
        ];
        $form = [
            [
                'type' => 'text',
                'name' => 'title',
                'label' =>  'Title',
            ],
            [
                'type' => 'image',
                'name' => 'thumbnail',
                'label' =>  'Thumbnail',
            ],

        ];
        return view('admin.category.index', compact('title', 'data', 'columns', 'form'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => ["required", "min:3"],
            "phone" => ["required", "min:11"],
            "address" => ["required"],
        ]);
        $cart = session('cart');
        if (isset($cart['data']) && is_array($cart['data'])) {

            $user = User::firstOrNew(['phone' => $request->phone], [
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "password" => Hash::make($request->phone),
            ]);

            if (!$user->exists) {
                $user->save();
            }

            $data = Order::create([
                "name" => $request->name,
                'code' => date('Ymd-His') . rand(10, 99),
                "phone" => $request->phone,
                "address" => $request->address,
                "total" => $cart['total_price'],
                "shipping_cost" => $cart['shipping_cost'],
                "order_date" => date("d/m/Y"),
                "order_month" => date("m"),
                "order_year" => date("Y"),
                "order_year" => date("Y"),
                'payment_method' => $request?->payment_method
            ]);

            foreach ($cart['data'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $product->decrement('stock', $item['quantity']);

                // $price = $item['price'] - ($item['price'] / 100) * $item['discount'];

                OrderItem::create([
                    "order_id" => $data->id,
                    "product_id" => $item['product_id'],
                    "qty" => $item['quantity'],
                    "total" => $item['price'] * $item['quantity'],
                    // "total" => $price * $item['quantity'],
                ]);
            }
            // return $request->payment_method;


            if ($request->payment_method == 'stripe') {
                // $html = View::make('frontend.partials.modal', compact('data'))->render();

                // return response()->json(['html' => $html]);

                return (new StripePaymentController())->stripe($data);
                //    if ( $stripeData) 
                //    {
                //     # code...
                //     return view('frontend.order_success', compact('data'));
                //    }
            } elseif ($request->payment_method == 'paypal') {
                return 'paypal';
            }
            // session('cart')->delete();
            return view('frontend.order_success', compact('data'));
            return response()->json(['message' => 'Order Place Successfully', 'data' => $data]);
        }

        return response()->json(['message' => 'Product not found in the cart'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::findOrFail($id);
    }
    public function invoice($id)
    {
        $settings = SiteSetting::first();
        $order = Order::findOrFail($id);

        $pdf = MPDf::chunkLoadView('<html-separator/>', 'pdf.order_pdf', ['order' => $order, 'setting' => $settings]);
        return $pdf->download("{$order->code}.pdf");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $order->code = date('Ymd-His') . rand(10, 99);
    }
    public function status(Request $request, $id)
    {
        $data = Order::findOrFail($id)->update([
            'status' => $request->status
        ]);
        if ($data) {
            return response()->json(['message' => 'Data Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Update Failed'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function multipleDelete(Request $request)
    {
        //    return  dd($request->selected_ids);
        $selectedItems = $request->input('selected_ids', []);

        // Delete selected items
        $data = Order::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = Order::findOrFail($request->id);
        $page->status = !$page->status;
        $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
