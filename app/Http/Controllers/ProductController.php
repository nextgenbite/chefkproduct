<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImages;
use App\Traits\BaseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use ImageUploadTrait, BaseTrait;
    private $imgLocation = 'images/products';
    private $title = ['Product', 'products'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title;
        $data = Product::with('images', 'category', 'brand')->get();

        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return $this->CrudCheckbox($row);
                })
                ->addColumn('thumbnail', function ($row) {
                    return $this->CrudImage($row->thumbnail);
                })
                ->addColumn('status', function ($row) {
                    return $this->CrudStatus($row);
                })
                ->addColumn('action', function ($row) {
                    return $this->CrudAction($row);
                })
                ->rawColumns(['checkbox', 'thumbnail', 'action', 'status'])
                ->make(true);
        }
        $columns = [
            [
                'data' => 'checkbox',
                'name' => 'checkbox',
                'title' =>  '<input type="checkbox" class="rounded-full" id="selectAll" />',
                'orderable' => false,
                'searchable' => false,
                'width' => '5%'
            ],
            [
                'data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Sl',
                'orderable' => false,
                'searchable' => false,
                'width' => '5%'  // Set width for checkbox column
            ],
            [
                'data' => 'thumbnail', 'name' => 'thumbnail', 'title' => 'Thumbnail',
                'orderable' => false,
                'searchable' => false,
                'width' => '10%'
            ],
            [
                'data' => 'category.title', 'name' => 'category.title', 'title' => 'Category',
                'width' => '20%'
            ],
            [
                'data' => 'title',
                'name' => 'title',
                'title' => 'Title',
                'width' => '50%',  // Set width for title column
                'sClass' => 'truncate w-25'
            ],
            [
                'data' => 'stock', 'name' => 'stock', 'title' => 'Stock',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'status', 'name' => 'status', 'title' => 'Status', 'sClass' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'action', 'name' => 'action', 'title' => 'Action', 'sClass' => 'text-center',
                'orderable' => false,
                'searchable' => false
            ],
        ];
        $form = [
            [
                'type' => 'text',
                'name' => 'title',
                'label' =>  'Title',
            ],
            [
                'type' => 'textarea',
                'name' => 'body',
                'label' =>  'Content',
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

        $thumbnail = "";
        if ($request->thumbnail) {
            $thumbnail = $this->uploadBase64Image($request->input('thumbnail'), $this->imgLocation);
        }
        $data = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'discount' => $request->discount,
            'thumbnail' => $thumbnail,
        ]);
        $magesData = '';
        if ($request->input('productImages')) {
            foreach ($request->input('productImages') as $mimage) {
                $image = $this->uploadBase64Image($mimage, 'images/products');
                $magesData =  ProductImages::create([
                    'product_id' => $data->id,
                    'path' => $image

                ]);
            }
        }
        if ($data) {
            return response()->json(['message' => 'Data Create successfully', 'data' => $data, 'magesData' => $magesData], 200);
        } else {
            return response()->json(['message' => 'Data Create Failed'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Product::with('images', 'category', 'brand')->whereId($id)->first();
        return response()->json($data, 200);
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
        $data = Product::findOrFail($id);

        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category_id = $request->category_id;
        $data->brand_id = $request->brand_id;
        $data->stock = $request->stock;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->description = $request->description;
        // Handle image update
        if ($request->newThumbnail) {
            $this->deleteImage($data->thumbnail);

            $newThumbnail = $this->uploadBase64Image($request->newThumbnail, $this->imgLocation);

            $data->thumbnail  = $newThumbnail;
        }
        $data->update();

        if ($request->input('productImages')) {
            $productImages = ProductImages::where('product_id', $id)->get();
            if (!$productImages->isEmpty()) {
                foreach ($productImages as $image) {
                    $this->deleteImage($image->path);
                    $image->delete();
                }
            }
            foreach ($request->input('productImages') as $mimage) {
                $image = $this->uploadBase64Image($mimage, 'images/products');
                $magesData =  ProductImages::create([
                    'product_id' => $id,
                    'path' => $image

                ]);
            }
        }
        if ($data) {
            return response()->json(
                ['message' => 'Data Update successfully', 'data' => $data, 'magesData' => $productImages ?? null],
                200
            );
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
        $data = Product::findOrFail($id);
        $this->deleteImage($data->thumbnail);
        $data->delete();

        if ($data) {
            return response()->json(['message' => 'Data Deleted successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Delete Failed'], 500);
        }
    }
}
