<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class CompanyServiceViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function services (){
        $data = [
            'title' => 'Company services',
            'keywords' => 'Company services',
            'description' => 'Company services',
        ];
        return view('livewire.company.pages.company-services-page', ['data' => $data, 'settings'   => $this->settings]);
    }

    public function serviceDetails ($id){
        $service = Service::find($id);
        $data = [
            'title' => 'Company services',
            'keywords' => 'Company services',
            'description' => 'Company services',
        ];
        return view('livewire.company.pages.company-service-details-page', ['data' => $data, 'service' => $service, 'settings'   => $this->settings]);
    }
}
