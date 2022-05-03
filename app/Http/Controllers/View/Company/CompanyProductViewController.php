<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
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
}
