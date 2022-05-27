<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function dashboard (){
        $data = [
            'title' => 'Company dashboard',
            'keywords' => 'Admin dashboard',
            'description' => 'Admin dashboard'
        ];
        return view('livewire.company.pages.company-dashboard-page', ['data' => $data, 'settings'   => $this->settings]);
    }

    public function usersList (){
        $data = [
            'title' => 'Users',
            'keywords' => 'Users',
            'description' => 'Users'
        ];
        return view('livewire.company.pages.companies-users-list-page', ['data' => $data, 'settings'   => $this->settings]);
    }

    public function settings (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Settings',
            'keywords' => 'Settings',
            'description' => 'Settings'
        ];
        return view('livewire.company.pages.company-settings-page', ['data' => $data, 'company' => $company, 'settings'   => $this->settings]);
    }


}
