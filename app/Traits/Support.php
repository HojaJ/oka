<?php


namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Support
{
    public static function storeImage($image){
        if (!file_exists('images')) {
            File::makeDirectory('images', 0777, true, true);
        }
        $extension = $image->getClientOriginalExtension();
        $imageName = Str::random(15).'.'.$extension;
        $image->move(public_path('images'), $imageName);
        return 'images/'. $imageName;
    }

    public static function storePageImage($image){
        if (!file_exists('pages')) {
            File::makeDirectory('pages', 0777, true, true);
        }
        $imageName = Str::random(15).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('pages'), $imageName);
        return 'pages/'. $imageName;
    }

    public static function storeFile($file){
        if (!file_exists('audios')) {
            File::makeDirectory('audios', 0777, true, true);
        }
        $filename = Str::random(15).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('audios'), $filename);
        return 'audios/'.$filename;
    }
}
