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

    /**
     * Update the API key's for other methods.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEnvKeys(Request $request)
    {
        try {
              $request->validate([
            'key' => 'required|array',
        ]);
            foreach ($request->key as $key => $value) {
    
                $envKey = strtoupper($key);
                $envValue = '"' . trim($value) . '"';
    
                $envFilePath = base_path('.env');
                if (file_exists($envFilePath)) {
                    $envContent = file_get_contents($envFilePath);
    
                    if (strpos($envContent, $envKey) !== false) {
                        $envContent = preg_replace(
                            '/^' . $envKey . '.*/m',
                            $envKey . '=' . $envValue,
                            $envContent
                        );
                    } else {
                        $envContent .= "\n" . $envKey . '=' . $envValue;
                    }
    
                    if (file_put_contents($envFilePath, $envContent) === false) {
                        throw new \Exception('Failed to write to .env file');
                    }
                } else {
                    throw new \Exception('.env file not found');
                }
            }
    
            return redirect()->back()->with([
                'message'     => 'Settings updated successfully',
                'alert-type'  => 'success'
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with([
                'message'     => 'Failed to update settings: ' . $e->getMessage(),
                'alert-type'  => 'error'
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;

        $settings = Setting::all()->pluck('svalue', 'skey');

        return view('admin.settings.index', compact('title', 'settings'));
    }

    public function social()
    {
        $title = ["Social Media Link"];

        $settings = Setting::all()->pluck('svalue', 'skey');

        return view('admin.settings.social_media', compact('title', 'settings'));
    }

    public function plugins()
    {
        $title = ["Plugin Setup"];

        $settings = Setting::all()->pluck('svalue', 'skey');
        $data = collect([
            'mail_mailer' => config('mail.mailers.smtp.transport'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_encryption' => config('mail.mailers.smtp.encryption'),
            'mail_username' => config('mail.mailers.smtp.username'),
            'mail_password' => config('mail.mailers.smtp.password'),
            'mail_password' => config('mail.mailers.smtp.password'),
            'mail_from_address' => config('mail.from.address'),
            
            'fedex_client_id' => config('fedex.client_id'),
            'fedex_secret_id' => config('fedex.secret_id'),
            'fedex_account_number' => config('fedex.account_number'),
        ])->all();
        return view('admin.settings.plugins', compact('title', 'settings', 'data'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|array',
        ]);
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
