<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomEnv extends Controller
{
    public function moveImage($imageFile = null, $imageName = null)
    {
        if ($imageFile && $imageName) {
            $path = public_path() . '/img/app';
            $uploadimages = $imageFile->move($path, $imageName);
            if ($uploadimages) {
                return 'success';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function loadImage($image_file)
    {
        return public_path() .  '/img/app/'  . $image_file;
    }
}
