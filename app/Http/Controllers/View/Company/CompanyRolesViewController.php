<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyRolesViewController extends Controller
{
    public function roles (){
        $data = [
            'title' => 'Roles',
            'keywords' => 'Company roles',
            'description' => 'Company roles'
        ];
        return view('livewire.company.pages.company-roles-page', ['data' => $data]);
    }
}
