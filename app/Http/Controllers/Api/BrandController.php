<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::all();
        return response()->json($data,200);
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
            $thumbnail = $this->uploadBase64Image($request->input('thumbnail'), 'images/brands');

        }
        $data = Brand::create([
            'title'=> $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail'=> $thumbnail ?? null,
        ]);
        if ($data) {
            return response()->json(['message' => 'Brand Update successfully', 'data'=> $data] ,200);
        } else {
            return response()->json(['message'=> 'Brand Update Failed'] ,404);
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
            return response()->json(['message' => 'Brand Get successfully', 'data'=> $data] ,200);
        } else {
            return response()->json(['message'=> 'Brand Get Failed'] ,404);
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
    if ($request->newThumbnail) {
        $this->deleteImage($data->thumbnail);
        $data->thumbnail = $this->uploadBase64Image($request->newThumbnail, 'images/brands');


    }
    $data->update();
    if ($data) {
        return response()->json(['message' => 'Brand Update successfully', 'data'=> $data] ,200);
    } else {
        return response()->json(['message'=> 'Brand Update Failed'] ,404);
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
        $data =Brand::findOrFail($id);
        $this->deleteImage($data->thumbnail);
        $data->delete();

        if ($data) {
            return response()->json(['message' => 'Brand Delete successfully', 'data'=> $data] ,200);
        } else {
            return response()->json(['message'=> 'Brand Delete Failed'] ,404);
        }

    }
}
