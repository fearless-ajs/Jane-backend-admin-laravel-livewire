<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class CompanyUsersViewController extends Controller
{
    public function workers (){
        $data = [
            'title' => 'Company workers',
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.Company.pages.Company-workers-list-page', ['data' => $data]);
    }

    public function workerProfile ($worker){
        $worker = Worker::findOrFail($worker);
        $data = [
            'title' => $worker->user->lastname. '  ' .$worker->user->firstname ,
            'keywords' => 'Company dashboard',
            'description' => 'Company dashboard'
        ];
        return view('livewire.Company.pages.Company-workers-info-page', ['data' => $data, 'worker' => $worker]);
    }

}
