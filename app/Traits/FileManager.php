<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;

trait FileManager
{
    public function deleteCatalogueImage($filename){
        File::delete(public_path('uploads/img/catalogues/'.$filename));
    }

    public function deleteUsersImage($filename){
        File::delete(public_path('uploads/img/users/'.$filename));
    }

    public function deleteDocuments($filename){
        File::delete(public_path('uploads/docs/'.$filename));
    }
}
