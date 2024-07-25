<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\BaseTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SubCategoryeController extends Controller
{
    use ImageUploadTrait, BaseTrait;

    private $imgLocation = "images/categories";
    private $title = ['Sub category', 'sub-categories'];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Category::whereNotNull('parent_id')->latest()->get();
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
        $categories = Category::whereNull('parent_id')->latest()->get();
        $form = [
            [
                'type' => 'select',
                'name' => 'parent_id',
                'label' =>  'Category',
                'data' =>  $categories,
            ],
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
        // $this->authorize('category.create');

        $thumbnail = "";
        if ($request->thumbnail) {
            $thumbnail = $this->uploadImage($request, 'thumbnail', $this->imgLocation, 300, 300);
        }
        $data = Category::create([
            'parent_id' => $request->parent_id ?: '',
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon,
            'thumbnail' => $thumbnail
        ]);
        if ($data) {
            return response()->json(['message' => 'Data Create successfully', 'data' => $data], 200);
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
        $data = Category::findOrFail($id);
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
        // $this->authorize('catgory.update');
        $data = Category::findOrFail($id);
        if ($request->has('parent_id')) {
            $data->parent_id = $request->parent_id;
        }
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->icon = $request->icon;
        // Handle image update

        if ($request->has('thumbnail')) {
            $this->deleteImage($data->thumbnail);
            $data->thumbnail = $this->uploadImage($request, 'thumbnail', $this->imgLocation, 300, 300);
        }
        $data->update();
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
        $data = Category::findOrFail($id);
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
        $data = Category::whereIn('id', $selectedItems)->delete();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' delete successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
    public function statusUpdate(Request $request)
    {

        $page = Category::findOrFail($request->id);
        $page->status = !$page->status;
        $data = $page->save();
        if ($data) {
            return response()->json(['message' => $this->title[0] . ' update successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => $this->title[0] . ' Get Failed'], 404);
        }
    }
}
