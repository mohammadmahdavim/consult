<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;


use Intervention\Image\Facades\Image;

class ImageService
{

    public function store($file_name,$file,$width,$height,$local)
    {
        $filePath = public_path($local);

        $img = Image::make($file->path());
        $img->resize($width , $height, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$file_name);

        $filePath = public_path('/images');
        $file->move($filePath, $file_name);

    }

    public function file($file_name,$file,$width,$height,$local)
    {
        $filename = time() . '.' . $cover->getClientOriginalExtension();
        $path = public_path('/images');
        $cover->move($path, $filename);

    }

}

