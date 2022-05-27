<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class CompanyTeamsViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }
    public function teams (){
        $data = [
            'title'       => 'Teams',
            'keywords'    => 'Company teams',
            'description' => 'Company teams'
        ];
        return view('livewire.company.pages.company-teams-page', ['data' => $data, 'settings'   => $this->settings]);
    }
}
