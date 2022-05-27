<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

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

    public function productPublicShowCase ($company_id, $product_slug){
        $product = Product::where('company_id', $company_id)->where('slug', $product_slug)->first();
        $missing = false;
        if (!$product){
            $missing = true;
        }
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-product-market-view-page', ['data' => $data, 'product' => $product, 'missing' => $missing, 'settings'   => $this->settings]);
    }
}
