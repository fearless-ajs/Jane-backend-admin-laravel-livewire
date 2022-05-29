<?php

namespace App\Http\Controllers\View\Error;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppErrorViewController extends Controller
{
    public function maintenanceMode(){

    }

    public function comingSoon(){

    }

    public function pageNotFound(){


    }

    public function serverError(){

    }

    public function unAuthorizedAccess(){
        $data = [
            'title' => 'Unauthorized access',
            'keywords' => 'Unauthorized access',
            'description' => 'Unauthorized access'
        ];
        return view('livewire.error.unauthorized-access-page', ['data'  =>  $data]);
    }

}
