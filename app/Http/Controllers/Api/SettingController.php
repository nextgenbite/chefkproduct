<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;
    private $imgLocation = 'images/settings/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SiteSetting::firstOrFail();
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


        $setting = SiteSetting::first();
        if (isset($setting)) {
            $data =$setting;
        } else {
            $data = new SiteSetting;
        }


         $data->app_name=$request->app_name;
         $data->email=$request->email;
         $data->address=$request->address;
         $data->facebook=$request->facebook;
         $data->twitter=$request->twitter;
         $data->instagram=$request->instagram;
         $data->linkedin=$request->linkedin;

                   // Handle image update
    if ($request->newFavicon) {
        $this->deleteImage($data->favicon);

        $newFavicon= $this->uploadBase64Image($request->newFavicon, $this->imgLocation, 'png');

        $data->favicon  = $newFavicon;
    }
    if ($request->newLogo) {
        $this->deleteImage($data->logo);

        $newLogo= $this->uploadBase64Image($request->newLogo, $this->imgLocation,'png');

        $data->logo  = $newLogo;
    }
    if (isset($setting)) {
        $data->update();
    } else {
        $data->save();
    }
    if ($data) {
        return response()->json(['message' => 'Data Update successfully', 'data'=> $data] ,200);
    } else {
        return response()->json(['message'=> 'Data Update Failed'] ,404);
    }


    }
}
