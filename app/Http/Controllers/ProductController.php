<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Size;
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
                'searchable' => false
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
                'width' => '35%',  // Set width for title column
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
        $categories = Category::with('children')->latest()->get();
        $brands = Brand::active()->latest()->get();
        $colors = Color::get();
        $sizes = Size::get();
        $form = [
            [
                'type' => 'text',
                'name' => 'title',
                'label' =>  'Title',
                'class' => 'col-span-6',
            ],
            [
                'type' => 'select',
                'name' => 'category_id',
                'label' =>  'Category',
                'data' =>  $categories,
                'key' =>  'title',
                'child' =>  'children',
                'mode' =>  'select-single',
                'class' => 'col-span-2',
                
            ],
            [
                'type' => 'select',
                'name' => 'brand_id',
                'label' =>  'Brand',
                'data' =>  $brands,
                'key' =>  'title',
                'class' => 'col-span-2',
            ],
            [
                'type' => 'number',
                'name' => 'price',
                'label' =>  'Price',
                'class' => 'col-span-2',
            ],
            [
                'type' => 'number',
                'name' => 'discount',
                'label' =>  'Discount Price',
                'class' => 'col-span-2',
            ],
            [
                'type' => 'number',
                'name' => 'stock',
                'label' =>  'Stock',
                'class' => 'col-span-2',
            ],
            [
                'type' => 'select',
                'name' => 'color_id',
                'label' =>  'Color',
                'data' =>  $colors,
                'key' =>  'name',
                'class' => 'col-span-2',
                'mode' =>  'select-mulitple',
            ],
            [
                'type' => 'select',
                'name' => 'size_id',
                'label' =>  'Size',
                'data' =>  $sizes,
                'key' =>  'name',
                'class' => 'col-span-2',
                'mode' =>  'select-mulitple',
            ],
            [
                'type' => 'image',
                'name' => 'thumbnail',
                'label' =>  'Thumbnail',
                'class' => 'col-span-2',
                'helper_text' => 'PNG, JPG(600x600px).',
            ],
            [
                'type' => 'multi-image',
                'name' => 'images',
                'label' =>  'Multiple Image',
                'class' => 'col-span-6',
                'helper_text' => 'PNG, JPG(800x800px).',
            ],
            [
                'type' => 'textarea',
                'name' => 'description',
                'label' =>  'Description',
                'class' => 'col-span-6',
            ],

        ];
        return view('admin.product.crud', compact('title', 'data', 'columns', 'form'));
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
        if ($request->has('thumbnail')) {
            $thumbnail = $this->uploadImage($request->thumbnail, $this->imgLocation, 600, 600);
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
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                // Calling the improved uploadImage method
                $uploadImage = $this->uploadImage( $image, $this->imgLocation, 800, 800);

                if ($uploadImage) {
                    $magesData =   ProductImages::create([
                        'product_id' => $data->id,
                        'path' => $uploadImage
                    ]);
                }
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

        if ($data) {
            return response()->json(['message' => 'Data successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Get Failed'], 404);
        }
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
        if ($request->has('thumbnail')) {
            $this->deleteImage($data->thumbnail);
            $data->thumbnail =$this->uploadImage($request->thumbnail, $this->imgLocation, 600, 600);
  
        }
        $data->update();
        $magesData ='';
        if ($request->has('images')) {
            $productImages = ProductImages::where('product_id', $id)->get();
            if (!$productImages->isEmpty()) {
                foreach ($productImages as $image) {
                    $this->deleteImage($image->path);
                    $image->delete();
                }
            }
            foreach ($request->file('images') as $image) {

                $uploadImage = $this->uploadImage($image, $this->imgLocation, 800, 800);
                if ($uploadImage) {
                    $magesData =  $data->images()->create([
                        'path' => $uploadImage

                    ]);
                }
            }
        }
        if ($data) {
            return response()->json(
                ['message' => 'Data Update successfully', 'data' => $data, 'magesData' => $magesData],
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
    public function multipleDelete(Request $request)
    {
        //    return  dd($request->selected_ids);
        $selectedItems = $request->input('selected_ids', []);

        // Delete selected items
        $data = Product::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = Product::findOrFail($request->id);
        $page->status = !$page->status;
        $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
