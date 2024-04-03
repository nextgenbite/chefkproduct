<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ImageUploadTrait;

    private $imgLocation = "images/categories";


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Category';

        $data = Category::latest()->get();
        if ($request->ajax()) {
  
  
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn=   '<button id="'. $row->id.'-dropdown-button"
                                            data-dropdown-toggle="'. $row->id.'-dropdown"
                                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="'. $row->id.'-dropdown"
                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="'. $row->id.'-dropdown-button">
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a  data-modal-target="data-modal" data-modal-toggle="data-modal"
                                                    data-id="'.$row->id.'" data-original-title="Edit"
                                                        href="javascript:void(0)"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white editData">Edit</a>

                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="javascript:void(0)"
                                                
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                            </div>
                                        </div>';
   
                        //    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                        //    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.category.index', compact('title','data'));
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
            $thumbnail = $this->uploadBase64Image($request->input('thumbnail'), $this->imgLocation);
        }
        $data = Category::create([
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
        $this->authorize('catgory.update');
        $data = Category::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->icon = $request->icon;
        // Handle image update
        if ($request->newThumbnail) {
            $this->deleteImage($data->thumbnail);
            $data->thumbnail = $this->uploadBase64Image($request->newThumbnail, $this->imgLocation);
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
}
