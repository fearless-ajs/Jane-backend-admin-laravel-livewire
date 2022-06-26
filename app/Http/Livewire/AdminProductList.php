<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Setting;
use App\Traits\FileManager;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductList extends LiveNotify
{
    use WithPagination;
    use FileManager;

    public $search;
    public $searchResult;

    public $order;

    public $categories;
    public $category;

    public $settings;

    public $company;
    public $companies;


    public $categorySearch;
    public $companySearch;


    protected $listeners = [
        'delete'    =>  'deleteProduct'
    ];

    public function updated(){
        if ($this->categorySearch){
            $this->categories = Category::where('name', 'LIKE', "%{$this->categorySearch}%")->get();
        }

        if ($this->companySearch){
            $this->companies = Company::where('name', 'LIKE', "%{$this->companySearch}%")->get();
        }

        if ($this->search){
            if ($this->order){
                if ($this->category){
                    $this->searchResult = CompanyCatalogue::where('type', 'product')
                        ->orderBy('price', $this->order)
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::where('type', 'product')->orderBy('price', $this->order)->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }else{
                if ($this->category){

                    $this->searchResult = CompanyCatalogue::where('type', 'product')->where('name', 'LIKE', "%{$this->search}%")->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::where('type', 'product')->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }
        }

    }

    public function clearFilter(){
        $this->category = null;
        $this->search = null;
        $this->searchResult = null;
        $this->order    = null;
        $this->categorySearch = null;
        $this->categories = null;
        $this->companySearch = null;
        $this->companies = null;
        $this->company = null;
    }

    public function setOrder($order='ASC'){
        $this->order = $order;
    }

    public function mount(){
        $this->settings = Setting::first();
    }

    public function remove($product_id){
        $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $product_id);
    }

    public function deleteProduct($product_id){
        $catalogue =  CompanyCatalogue::find($product_id);


        if (count($catalogue->images) > 0){
            foreach ($catalogue->images as $image){
                // Delete product image
                $this->deleteCatalogueImage($image->image);
                $image->delete();
            }
        }

        $catalogue->delete();
//
//        $this->emit('refreshAdminProductList');
        return $this->alert('success', 'Product deleted', 'Press ok to continue');
//        return $this->emit('alert', ['type' => 'success', 'message' => 'Product removed']);
    }

    public function render()
    {
        if ($this->companySearch && $this->company){
            if ($this->searchResult && !empty($this->search)){
                return view('livewire.admin.components.admin-product-list', [
                    'catalogues' => $this->searchResult
                ]);
            }else {
                $this->searchResult = false;
                if ($this->category){
                    if ($this->order){
                        return view('livewire.admin.components.admin-product-list', [
                            'catalogues' => CompanyCatalogue::where('type', 'product')->where('category', $this->category)->where('company_id', $this->company)->orderBy('price', $this->order)->paginate(12)
                        ]);
                    }else{
                        return view('livewire.admin.components.admin-product-list', [
                            'catalogues' => CompanyCatalogue::where('type', 'product')->where('category', $this->category)->where('company_id', $this->company)->paginate(12)
                        ]);
                    }
                }else{
                    return view('livewire.admin.components.admin-product-list', [
                        'catalogues' => CompanyCatalogue::where('type', 'product')->where('company_id', $this->company)->paginate(12)
                    ]);
                }
            }
        }else{
            if ($this->searchResult && !empty($this->search)){
                return view('livewire.admin.components.admin-product-list', [
                    'catalogues' => $this->searchResult
                ]);
            }else {
                $this->searchResult = false;
                if ($this->category){
                    if ($this->order){
                        return view('livewire.admin.components.admin-product-list', [
                            'catalogues' => CompanyCatalogue::where('type', 'product')->where('category', $this->category)->orderBy('price', $this->order)->paginate(12)
                        ]);
                    }else{
                        return view('livewire.admin.components.admin-product-list', [
                            'catalogues' => CompanyCatalogue::where('type', 'product')->where('category', $this->category)->paginate(12)
                        ]);
                    }
                }else{
                    return view('livewire.admin.components.admin-product-list', [
                        'catalogues' => CompanyCatalogue::where('type', 'product')->paginate(12)
                    ]);
                }
            }
        }
    }
}
