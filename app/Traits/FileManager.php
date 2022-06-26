<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait FileManager
{
    public function deleteCatalogueImage($filename){
        File::delete(public_path('uploads/img/catalogues/'.$filename));
    }

    public function deleteUsersImage($filename){
        File::delete(public_path('uploads/img/users/'.$filename));
    }

    public function deleteSignature($filename){
        File::delete(public_path('uploads/img/signatures/'.$filename));
    }

    public function deleteDocuments($filename){
        File::delete(public_path('uploads/docs/'.$filename));
    }

    public function saveImage($image, $disk){
        // Process the image
        $img = Image::make($image)->resize(350, 250)->encode('png');
        $name = Str::random(50).'_'.$image->getClientOriginalName();;
        Storage::disk($disk)->put($name, $img);

        return $name;
    }

    public function saveUserAvatar($image, $disk){
        // Process the image
        $img = Image::make($image)->resize(200, 200)->encode('jpg');
        $name = Str::random(50).'_'.$image->getClientOriginalName();;
        Storage::disk($disk)->put($name, $img);

        return $name;
    }
}
