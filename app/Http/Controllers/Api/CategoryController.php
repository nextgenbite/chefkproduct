<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
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
    public function index()
    {
        $data = Category::all();
        return response()->json($data, 200);
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

        $data = Category::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->icon = $request->icon;
        $data->title = $request->title;
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
