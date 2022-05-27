<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public $settings;
    public function __construct()
    {
        // Initializing system settings
        if (!Setting::first()){
            $user = User::where('user_type', 'super-admin')->first();
            Setting::create([
                'user_id'               =>  $user->id,
                'app_name'              =>  'Sandpiper',
                'app_email'             =>  'Sandpiper@app.com',
                'app_currency'          =>  'Naira',
                'app_currency_symbol'   =>  'N',
                'app_country'           =>  'Nigeria'
            ]);
        }

        $this->settings = Setting::first();
    }

    public function dashboard (){
        $data = [
            'title' => 'Admin dashboard',
            'keywords' => 'Admin dashboard',
            'description' => 'Admin dashboard'
        ];
        return view('livewire.admin.pages.admin-dashboard-page', ['data' => $data, 'settings'  =>  $this->settings]);
    }

    public function usersList (){
        $data = [
            'title' => 'Users',
            'keywords' => 'Users',
            'description' => 'Users'
        ];
        return view('livewire.admin.pages.admin-users-list-page', ['data' => $data,  'settings'  =>  $this->settings]);
    }

    public function settings(){
        $data = [
            'title' => 'Settings',
            'keywords' => 'Settings',
            'description' => 'Settings'
        ];
        return view('livewire.admin.pages.admin-settings-page', ['data' => $data,  'settings'  =>  $this->settings]);
    }

}
