<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function dashboard (){
        $data = [
            'title' => 'Admin dashboard',
            'keywords' => 'Admin dashboard',
            'description' => 'Admin dashboard'
        ];
        return view('livewire.admin.pages.admin-dashboard-page', ['data' => $data]);
    }

    public function usersList (){
        $data = [
            'title' => 'Users',
            'keywords' => 'Users',
            'description' => 'Users'
        ];
        return view('livewire.admin.pages.admin-users-list-page', ['data' => $data]);
    }

}
