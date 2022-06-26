<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminCatalogueViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function products(){
        $data = [
            'title' => 'Products',
            'keywords' => 'Products',
            'description' => 'Products'
        ];
        return view('livewire.admin.pages.admin-products-page', ['data' => $data]);
    }

    public function services(){
        $data = [
            'title' => 'Services',
            'keywords' => 'Services',
            'description' => 'Services'
        ];
        return view('livewire.admin.pages.admin-services-page', ['data' => $data]);
    }

    public function catalogueDetails($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $data = [
            'title' => $catalogue->name,
            'keywords' => 'Products',
            'description' => 'Products'
        ];
        return view('livewire.admin.pages.admin-catalogue-details-page', ['data' => $data, 'catalogue' => $catalogue]);
    }

}
