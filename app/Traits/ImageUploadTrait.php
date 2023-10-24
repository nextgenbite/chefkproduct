<?php

namespace App\Traits;
use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{

    public function uploadBase64Image($base64Data, $destinationPath , $ext = 'webp')
    {

        $name = time() . "." . $ext;
        $img = Image::make($base64Data);

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image_url = $destinationPath . $name;

        $height = $img->height();
        $width = $img->width();

        if ($width > $height && $width > 1500) {
            $img->resize(1500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } elseif ($height > 1500) {
            $img->resize(null, 1500, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

// // // Full path to the saved image
$fullImagePath = public_path($image_url); // Assuming you're saving images in the public directory

// // // Use ImageMagick's "convert" command to optimize the image
exec("convert '$fullImagePath' -strip -interlace Plane -quality 85 '$fullImagePath'");

        $img->save($image_url);

        return $image_url;

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
