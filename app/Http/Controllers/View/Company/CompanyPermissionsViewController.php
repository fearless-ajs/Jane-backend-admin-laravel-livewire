<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyPermissionsViewController extends Controller
{
    public function permissions (){
        $data = [
            'title' => 'Permissions',
            'keywords' => 'Company permissions',
            'description' => 'Company permissions'
        ];
        return view('livewire.company.pages.company-permissions-page', ['data' => $data]);
    }
}
