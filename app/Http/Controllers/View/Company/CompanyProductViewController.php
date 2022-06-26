<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProductViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function categories (){
        $data = [
            'title' => 'Company product Category',
            'keywords' => 'Company product Category',
            'description' => 'Company product Category',
        ];
        return view('livewire.company.pages.company-categories-list-page', ['data' => $data, 'settings'   => $this->settings]);
    }

    public function billingCycle (){
        $data = [
            'title' => 'Company product Category',
            'keywords' => 'Company product Category',
            'description' => 'Company product Category',
        ];
        return view('livewire.company.pages.company-billing-cycle-list-page', ['data' => $data, 'settings'   => $this->settings]);
    }

    public function taxes (){
        $data = [
            'title' => 'Company taxes',
            'keywords' => 'Company taxes',
            'description' => 'Company product Category',
        ];
        return view('livewire.company.pages.company-tax-list-page', ['data' => $data]);
    }

    public function products (){
        $data = [
            'title' => 'Company products',
            'keywords' => 'Company products',
            'description' => 'Company products',
        ];
        return view('livewire.company.pages.company-products-page', ['data' => $data, 'settings'   => $this->settings]);
    }


    public function productDetails ($id){
        $product = Product::find($id);
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-product-details-page', ['data' => $data, 'product' => $product, 'settings'   => $this->settings]);
    }


    public function catalogues (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Company products',
            'keywords' => 'Company products',
            'description' => 'Company products',
        ];
        return view('livewire.company.pages.company-catalogue-list-page', ['data' => $data, 'company' => $company]);
    }

    public function catalogueDetails ($id){
        $catalogue = CompanyCatalogue::find($id);
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-catalogue-details-page', ['data' => $data, 'catalogue' => $catalogue]);
    }

    public function productPublicShowCase ($company_id, $catalogue_slug){
        $catalogue = CompanyCatalogue::where('company_id', $company_id)->where('slug', $catalogue_slug)->first();
        $missing = false;
        if (!$catalogue){
            $missing = true;
        }
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-product-market-view-page', ['data' => $data, 'catalogue' => $catalogue, 'missing' => $missing]);
    }
}
