<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageUploadTrait;

    private $title = ['Setting', 'setting'];
    private $imgLocation = 'images/settings/';

    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }

        /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        // flash(translate("Settings updated successfully"))->success();
        return back();
    }






    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this-> title;
   
        $settings = Setting::all()->pluck('svalue', 'skey');

        return view('admin.settings.index', compact('title','settings'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $setting = Setting::first();
        if (isset($setting)) {
            $data =$setting;
        } else {
            $data = new Setting;
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

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|array',
        ]);
//  return $request->dd();
        foreach ($request->key as $key => $value) {
            if ($key == 'logo' || $key == 'favicon') {
                // Process image upload

                $setting = Setting::where('skey', $key)->first();
                if ($setting && file_exists(public_path($setting->svalue))) {
                    unlink(public_path($setting->svalue));
                }
                $image_name = hexdec(uniqid());
                $ext = strtolower($value->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $image_url = $this->imgLocation . $image_full_name;
                $success = $value->move($this->imgLocation, $image_full_name);

                // Assign image URL to $value
                $value = $image_url;
            }

            // Store configuration setting
            Setting::updateOrCreate(
                ['skey' => $key],
                ['svalue' => $value]
            );
        }

        $notification = [
            'message' => 'Settings Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
