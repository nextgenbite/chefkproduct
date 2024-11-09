<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\SiteSetting;
use App\Models\User;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as MPDF;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\{Mail, Session, Log, Hash, View};
use App\Services\StripeService;
use Exception;


class OrderController extends Controller
{

    use  BaseTrait;
    private $title = ['Order', 'orders'];
    protected $stripeService;
    protected $fedexService;
    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

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


                ->addColumn('status', function ($row) {
                    return $this->OrderStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->OrderAction($row);
                })
                ->rawColumns(['checkbox',  'status',  'action'])
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
            [
                'data' => 'user.email',
                'name' => 'user.email',
                'title' => 'Email',
                'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'phone', 'name' => 'phone', 'title' => 'Phone'],
            ['data' => 'total', 'name' => 'total', 'title' => 'Total', 'sClass' => 'text-right'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status', 'sClass' => 'text-center'],

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
        // Validate the request
        $this->validate($request, [
            "name" => ["required", "min:3"],
            // "phone" => ["required", "min:11"],
            "email" => ["required"],
            "city" => ["required"],
            "state" => ["required"],
            "address" => ["required"],
        ]);

        $cart = $this->getUserCart();
        $totalQuantity = $cart->items()->sum('quantity');
        if ($cart &&  $totalQuantity > 5) {
            if ($cart->shipping_cost || $cart->shipping_cost = '0.00') {
                $notification = array(
                    'messege' => 'Address is not validate!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->withInput()->with($notification);
            }
            // Find or create the user
            $user = User::firstOrNew(['phone' => $request->phone], [
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "password" => Hash::make($request->phone),
            ]);

            if (!$user->exists) {
                $user->save();
            }

            // Create the order
            $order = Order::create([
                "user_id" => $user->id ?? '',
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                'code' => date('Ymd-His') . rand(10, 99),
                "country" => $request->country,
                "city" => $request->city,
                "state" => $request->street,
                "address" => $request->address,
                "total" => $cart['total'],
                // "shipping_cost" => $cart['shipping_cost'],
                "order_date" => date("d/m/Y"),
                "order_month" => date("m"),
                "order_year" => date("Y"),
                'payment_method' => $request->payment_method
            ]);

            // Add order items and decrement product stock
            foreach ($cart->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $item['product_id'],
                    "qty" => $item['quantity'],
                    "total" => $item->product->price * $item['quantity'],
                ]);
            }

            // Handle payment based on the selected method
            $strip =  $this->stripeService->createPayment($order, $request->stripeToken);
            if ($strip->status == "succeeded") {
                $order->update(['payment_status' => 'paid']);
                $notification = array(
                    'messege' => 'Payment successful!!',
                    'alert-type' => 'success'
                );
                return view('frontend.order_success', compact('order'))->with($notification);
            } else {
                Session::flash('success', 'Payment faild!');
                Log::error('Failed to create stripe payment:', ['response' => $strip]);
                throw new Exception('Failed to create stripe payment: ' . ($data['errorMessage'] ?? 'Unknown error'));
            }
            $recipients = [
                ['email' => Setting::where('skey', 'email')->first()->svalue, 'view' => 'emails.admin_order'],
                ['email' => $request->email, 'view' => 'emails.new_order']
            ];

            foreach ($recipients as $recipient) {
                Mail::to($recipient['email'])->send(new OrderMail($recipient['view']));
            }
        } else if ($totalQuantity < 6) {

            // return response()->json(['message' => 'Product quantity must be 6']);
            $notification = array(
                'messege' => 'Cart quantity must be 6 or more!',
                'alert-type' => 'error'
            );
            return redirect()->back()->withInput()->with($notification);
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
        return view('admin.orders.show', ['order' => $data]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Order::findOrFail($id)->delete();
        } catch (Exception $e) {
            return response()->json(['message' => 'Data Update Failed'], 404);
        }
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

        try {
            $data = Order::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            if ($data) {
                return response()->json(['message' => 'Data Update successfully', 'data' => $data], 200);
            } else {
                return response()->json(['message' => 'Data Update Failed'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Data Update Failed'], 404);
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
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 uppercase">' . $row->payment_method . '</span>';
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
                return '<span class="bg-red-100 text-yellow-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';
                break;
            case 'canceled':
                return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Canceled</span>';
                break;
            case 'completed':
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>';
                break;
            case 'delivered':
                return '<span class="bg-green-100 text-green-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Delivered</span>';
                break;
            default:
                return '<span class="bg-red-100 text-red-500 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Pending</span>';
        }
    }
    public function OrderAction($row)
    {
        $dropdownId = "dropdownDotsHorizontal{$row->id}";
        $buttonId = "dropdownMenuIconHorizontalButton{$row->id}";

        // Start building the dropdown button and menu
        $actionHtml = "
<button id='{$buttonId}' data-dropdown-toggle='{$dropdownId}' 
    class='p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600'
    type='button'>
    <i class='fa-solid fa-ellipsis'></i>
</button>

<!-- Dropdown menu -->
<div id='{$dropdownId}' class='z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600'>
    <ul class='text-sm text-gray-700 dark:text-gray-200 text-left divide-y divide-dotted divide-gray-200' aria-labelledby='{$buttonId}'>
      <li>
        <a href='/admin/orders/invoice/{$row->id}' title='Order details' class='block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>
            <i class='fa-solid fa-eye w-4 h-4 mr-2'></i>View
        </a>
      </li>";

        // Only show "Cancel" and "Delivery" options if the status is "Pending"
        if ($row->status == 'pending') {
            $actionHtml .= "
      <li>
        <a href='javascript:void(0)' title='Cancel' id='btn-cancel' data-status='canceled' data-id='{$row->id}' class='block px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>
            <i class='fa-solid fa-ban mr-2'></i>Cancel
        </a>
      </li>
      <li>
        <a href='javascript:void(0)' title='Delivery' id='btn-delivery' data-status='delivered' data-id='{$row->id}' class='block px-4 py-2 text-green-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>
            <i class='fa-solid fa-truck mr-2'></i>Delivery
        </a>
      </li>";
        }

        // Delete option
        $actionHtml .= "
      <li>
        <a href='javascript:void(0)' data-id='{$row->id}' class='block px-4 py-2 text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'>
            <i class='fa-solid fa-trash mr-2'></i>Delete
        </a>
      </li>
    </ul>
</div>";

        return $actionHtml;
    }

    private function getUserCart()
    {
        return Cart::firstOrCreate(
            ['guest_id' => session()->getId(), 'user_id' => auth()->id()]
        );
    }
}
