<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class CompanyProductViewController extends Controller
{
    public function products (){
        $data = [
            'title' => 'Company products',
            'keywords' => 'Company products',
            'description' => 'Company products',
        ];
        return view('livewire.Company.pages.Company-products-page', ['data' => $data]);
    }

    public function productDetails ($id){
        $product = Product::find($id);
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-product-details-page', ['data' => $data, 'product' => $product]);
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
        return view('livewire.company.pages.company-product-market-view-page', ['data' => $data, 'product' => $product, 'missing' => $missing]);
    }
}
