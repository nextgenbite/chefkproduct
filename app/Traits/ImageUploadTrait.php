<?php

namespace App\Traits;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
trait ImageUploadTrait
{
    
    public function uploadBase64Image($base64Data, $destinationPath, $ext = 'webp')
    {
        $name = Str::random(10) . '.' . $ext; // Generate a random name for the image
        $imagePath = public_path($destinationPath);
    
        // Make the directory if it doesn't exist
        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0755, true);
        }
    
        $image_url = $destinationPath . $name;
    
        // Create an image instance from base64 data
        $img = Image::make($base64Data);
    
        // Resize the image if it's larger than 1500px in width or height
        if ($img->width() > 1500 || $img->height() > 1500) {
            $img->resize(1500, 1500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
    
        // Save the image
        $img->save(public_path($image_url));
    
        return $image_url;
    }
    
    
    public function uploadImage(Request $request, $fieldName, $path, $width = 300, $height = 300, $quality = 80)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path($path);
    
            // Make the directory if it doesn't exist
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
    
            $img = Image::make($image->getRealPath());
            // Resize the image while maintaining aspect ratio
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Save the optimized image with specified quality
            $img->save($destinationPath . '/' . $imageName, $quality);
    
            return $path . '/' . $imageName;
        } else {
            return null;
        }
    }




    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file
            return true;
        }
        return false;
    }
}
