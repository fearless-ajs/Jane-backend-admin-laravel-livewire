<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\ApiController;
use App\Models\Category;
use App\Models\CompanyCatalogue;
use App\Models\Product;

class ProductCategoryController extends ApiController
{
    public function categories(){
        $categories = Category::all()->groupBy('name');
        return $this->showAll($categories);
    }

    public function companyCategories($company_id){
        $categories = Category::where('company_id', $company_id)->get();
        return $this->showAll($categories);
    }

    public function categoryProducts($category_name){
        $products   = CompanyCatalogue::where('category', $category_name)->get();
        return $this->showAll($products);
    }
}
