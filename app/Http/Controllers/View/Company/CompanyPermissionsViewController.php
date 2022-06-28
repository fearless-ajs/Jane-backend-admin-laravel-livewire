<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyPermission;
use App\Models\CompanyRole;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyPermissionsViewController extends Controller
{

    public function permissions (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Permissions',
            'keywords' => 'Company permissions',
            'description' => 'Company permissions'
        ];
        return view('livewire.company.pages.company-permissions-page', ['data' => $data, 'company' => $company]);
    }

    public function permissionDetails ($id){
        $permission = CompanyPermission::find($id);
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Permissions',
            'keywords' => 'Company permissions',
            'description' => 'Company permissions'
        ];
        return view('livewire.company.pages.company-permission-details-page', ['data' => $data, 'company' => $company, 'permission' => $permission]);
    }

    public function roleDetails ($id){
        $role = CompanyRole::find($id);
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Role',
            'keywords' => 'Role',
            'description' => 'Role'
        ];
        return view('livewire.company.pages.company-role-details-page', ['data' => $data, 'company' => $company, 'role' => $role]);
    }
}
