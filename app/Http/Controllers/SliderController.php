<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Traits\BaseTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    use ImageUploadTrait;

    use ImageUploadTrait, BaseTrait;

    private $title = ['Slider', 'sliders'];
    private $imgLocation = "images/sliders";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index(Request $request)
    {
        $title = $this->title;

        $data = Slider::with('category')->get();
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
            ['data' => 'position', 'name' => 'position', 'title' => 'Position'],
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
        // $this->authorize('Slider.create');

        $thumbnail = "";
        if ($request->thumbnail) {
            $thumbnail = $this->uploadBase64Image($request->input('thumbnail'), $this->imgLocation);
        }
        $data = Slider::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->title),
            'position' => $request->position,
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
        $data = Slider::findOrFail($id);
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

        $data = Slider::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->category_id = $request->category_id;
        $data->position = $request->position;
        // Handle image update
        if ($request->newThumbnail) {
            $this->deleteImage($data->thumbnail);
            $data->thumbnail = $this->uploadBase64Image($request->newThumbnail, $this->imgLocation);
        }
        $data->update();
        if ($data) {
            return response()->json(['message' => 'Data Update successfully','status'=> 200, 'data' => $data], 200);
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
        $data = Slider::findOrFail($id);
        $this->deleteImage($data->thumbnail);
        $data->delete();

        if ($data) {
            return response()->json(['message' => 'Data Deleted successfully', 'data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data Delete Failed'], 500);
        }
    }
}
