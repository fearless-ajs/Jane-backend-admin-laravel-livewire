<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyUsersViewController extends Controller
{
    public function workers (){
        $data = [
            'title' => 'Company workers',
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.company.pages.company-workers-list-page', ['data' => $data]);
    }

}
