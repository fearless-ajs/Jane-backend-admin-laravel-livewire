<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyUsersViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function workers (){
        $data = [
            'title' => 'Company workers',
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.company.pages.company-workers-list-page', ['data' => $data, 'settings'  => $this->settings]);
    }

    public function workerProfile ($worker){
        $worker = Worker::findOrFail($worker);
        $data = [
            'title' => $worker->user->lastname. '  ' .$worker->user->firstname ,
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.company.pages.company-workers-info-page', ['data' => $data, 'worker' => $worker, 'settings'  => $this->settings]);
    }

    public function myProfile (){
        $user = Auth::user();
        $data = [
            'title' => $user->lastname. '  ' .$user->firstname ,
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.company.pages.company-my-user-info-page', ['data' => $data, 'user' => $user, 'settings'  => $this->settings]);
    }

}
