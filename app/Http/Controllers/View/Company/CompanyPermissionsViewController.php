<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPermission;
use App\Models\CompanyRole;
use App\Models\Setting;
use Illuminate\Http\Request;

class CompanyPermissionsViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function permissions (){
        $data = [
            'title' => 'Permissions',
            'keywords' => 'Company permissions',
            'description' => 'Company permissions'
        ];
        return view('livewire.company.pages.company-permissions-page', ['data' => $data, 'settings' => $this->settings]);
    }

    public function permissionDetails ($id){
        $permission = CompanyPermission::find($id);
        $data = [
            'title' => 'Permissions',
            'keywords' => 'Company permissions',
            'description' => 'Company permissions'
        ];
        return view('livewire.company.pages.company-permission-details-page', ['data' => $data, 'settings' => $this->settings, 'permission' => $permission]);
    }

    public function roleDetails ($id){
        $role = CompanyRole::find($id);
        $data = [
            'title' => 'Role',
            'keywords' => 'Role',
            'description' => 'Role'
        ];
        return view('livewire.company.pages.company-role-details-page', ['data' => $data, 'settings' => $this->settings, 'role' => $role]);
    }
}
