<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{

    public function uploadBase64Image($base64Data, $destinationPath, $fileNamePrefix = '')
    {
        // Extract image data from the base64 string
        list($type, $data) = explode(';', $base64Data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        // Generate a unique file name
        $fileName = $fileNamePrefix . Str::random(10) . '.png'; // You can adjust the file extension

        // Generate the full file path
        $fullFilePath = $destinationPath . '/' . $fileName;

        // Upload the image
        $uploaded = Storage::disk('public')->put($fullFilePath, $data);

        if ($uploaded) {
            // Optimize and resize the uploaded image
            $this->optimizeAndResizeImage(storage_path('app/public/') . $fullFilePath);

            return $fullFilePath;
        }

        return null;
    }

    protected function optimizeAndResizeImage($imagePath)
    {
        try {
            $img = Image::make($imagePath)->encode();
            $height = $img->height();
            $width = $img->width();

            if ($width > $height && $width > 1500) {
                $img->resize(1500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } elseif ($height > 1500) {
                $img->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->save($imagePath);
            clearstatcache();
        } catch (\Exception $e) {
            // Handle any exceptions here
        }
    }

    public function deleteImage($imagePath)
    {
        if (!empty($imagePath)) {
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
                return true;
            }
        }
        return false;
    }
}
