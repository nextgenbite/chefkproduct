<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\BaseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BrandController extends Controller
{

    use ImageUploadTrait, BaseTrait;
    public $title = ["Brand", 'brands'];
    private $imgLocation = "images/brands";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Brand::latest()->get();
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
                'data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => 'Sl', 'orderable' => false,
                'searchable' => false
            ],
            [
                'data' => 'thumbnail', 'name' => 'thumbnail', 'title' => 'Thumbnail',
                'orderable' => false,
                'searchable' => false
            ],
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
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
        $thumbnail = "";
        if ($request->has('thumbnail')) {
            $thumbnail = $this->uploadImage($request->thumbnail, $this->imgLocation, 300, 300);
        }
        $data = Brand::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $thumbnail ?? null,
        ]);
        if ($data) {
            return response()->json(['message' => 'Brand Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Brand Update Failed'], 404);
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
        $data = Brand::findOrFail($id);
        if ($data) {
            return response()->json(['message' => 'Brand Get successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Brand Get Failed'], 404);
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
        $data = Brand::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        // Handle image update
        if ($request->has('thumbnail')) {
            $this->deleteImage($data->thumbnail);
            $data->thumbnail = $this->uploadImage($request->thumbnail, $this->imgLocation, 300, 300);
        }
        $data->update();
        if ($data) {
            return response()->json(['message' => 'Brand Update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Brand Update Failed'], 404);
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
        $data = Brand::findOrFail($id);
        $this->deleteImage($data->thumbnail);
        $data->delete();

        if ($data) {
            return response()->json(['message' => 'Brand Delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Brand Delete Failed'], 404);
        }
    }

    public function multipleDelete(Request $request)
    {
        //    return  dd($request->selected_ids);
        $selectedItems = $request->input('selected_ids', []);

        // Delete selected items
        $data = Brand::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = Brand::findOrFail($request->id);
        $page->status = !$page->status;
        $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
