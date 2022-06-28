<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyRolesViewController extends Controller
{

    public function roles (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Roles',
            'keywords' => 'Company roles',
            'description' => 'Company roles'
        ];
        return view('livewire.company.pages.company-roles-page', ['data' => $data, 'company'   => $company]);
    }
}
