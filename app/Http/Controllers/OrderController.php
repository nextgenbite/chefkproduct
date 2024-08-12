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

        $data = Order::with('user')->latest()->get();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })

                ->addColumn('payment_method', function ($row) {
                    return $this->OrderPaymentMethod($row);
                })
                ->addColumn('payment_status', function ($row) {
                    return $this->OrderPaymentStatus($row);
                })
                ->addColumn('status', function ($row) {
                    return $this->OrderStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->OrderAction($row);
                })
                ->rawColumns(['checkbox','payment_method','payment_status', 'status',  'action'])
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
                'data' => 'order_date',
                'name' => 'order_date',
                'title' => 'Date',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'user.name',
                'name' => 'user.name',
                'title' => 'Name',
                'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total', 'sClass' => 'text-right'],
            ['data' => 'payment_method', 'name' => 'payment_method', 'title' => 'Payment Method', 'sClass' => 'text-center'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status', 'sClass' => 'text-center'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Delivery Status', 'sClass' => 'text-center'],

            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Action',
                'sClass' => 'text-center',
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
        return view('admin.test.crud', compact('title', 'data', 'columns', 'form'));
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
                "user_id" => $user ?? '',
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
        $data = Order::findOrFail($id);
return view('admin.orders.show', ['order'=> $data]);
    }
    public function invoiceDownload($id)
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
    public function OrderPaymentMethod($row)
    {
        switch ($row->payment_method) {
            case 'pending':
               return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';
                break;
            case 'cash_on_delivary':
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">COD</span>';
                break;
            default:
            return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';

        }
    }
    public function OrderPaymentStatus($row)
    {
        switch ($row->payment_status) {
            case 'pending':
               return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';
                break;
            case 'paid':
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Paid</span>';
                break;
            default:
            return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';

        }
    }
    public function OrderStatus($row)
    {
        switch ($row->status) {
            case 'pending':
               return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';
                break;
            case 'completed':
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>';
                break;
            default:
            return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';

        }
    }

    public function OrderAction($row)
    {
        return ' <div class="inline-flex rounded-md shadow-sm" role="group">
                 <a href="/admin/orders/invoice/' . $row->id . '" class="inline-flex items-center px-2 py-1 text-sm font-medium text-green-600 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-primary-800 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                     <span class="material-symbols-sharp w-1 h-1 ">visibility</span>
                 </a>
                 <button title="edit" data-id="' . $row->id . '" type="button" class="editData inline-flex items-center px-2 py-1 text-sm font-medium text-teal-600 bg-transparent border-t border-b border-gray-900 hover:bg-gray-800 hover:text-primary-800 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                     <span class="material-symbols-sharp w-1 h-1 ">edit_note</span>
                 </button>
                 <button type="button" data-id="' . $row->id . '" id="delete" class="inline-flex items-center px-2 py-1 text-sm font-medium text-red-600 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-primary-800 focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                     <span class="material-symbols-sharp w-1 h-1 ">delete</span>
                 </button>
             </div>';
    }
}
