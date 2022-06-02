<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyCreateProductForm extends LiveNotify
{
    use WithFileUploads;

    public $name;
    public $brand;
    public $price;
    public $previous_price;
    public $quantity;
    public $category;
    public $vat;
    public $currency;
    public $manufacturer;
    public $description;
    public $status;
    public $money_back;
    public $warranty;
    public $active;
    public $images = [];

    public $categories;

    public function mount(){
        $this->fetchCategories();
    }

    public function fetchCategories(){
        $this->categories = Category::where('company_id', Auth::user()->company_id)->get();
    }

    public function updated($field){
        $this->validateOnly($field, [
           'name'                   => 'required|max:255',
           'brand'                  => 'nullable|max:255',
           'price'                  => 'required|numeric|min:1',
           'vat'                    => 'nullable|numeric|min:1|max:100',
           'quantity'               => 'required|numeric|min:1',
           'previous_price'         => 'nullable|numeric|min:1',
           'currency'               => 'nullable|string|max:23',
           'category'               => 'nullable|string|max:255',
           'manufacturer'           => 'nullable|string|max:255',
           'description'            => 'required|string|max:1000',
           'money_back'             => 'nullable|numeric|min:0',
           'warranty'               => 'nullable',
           'active'                 => 'nullable',
           'images'                 => 'required|array|min:1|max:10',
           'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',

        ]);
    }

    public function removeImg($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function addProduct()
    {
        $this->validate([
            'name'                   => 'required|max:255',
            'brand'                  => 'nullable|max:255',
            'price'                  => 'required|numeric|min:1',
            'vat'                    => 'nullable|numeric|min:1|max:100',
            'quantity'               => 'required|numeric|min:1',
            'previous_price'         => 'nullable|numeric|min:1',
            'currency'               => 'nullable|string|max:23',
            'category'               => 'nullable|string|max:255',
            'manufacturer'           => 'nullable|string|max:255',
            'description'            => 'required|string|max:1000',
            'money_back'             => 'nullable|numeric|min:0',
            'warranty'               => 'nullable',
            'active'                 => 'nullable',
            'images'                 => 'required|array|min:1|max:10',
            'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        // Check if the product exist for the company
        if (Product::where('company_id', Auth::user()->company_id)->where('name', $this->name)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Product exist already']);
        }

        // Save the product information
       $product =  Product::create([
            'company_id'            => Auth::user()->company_id,
            'user_id'               => Auth::user()->id,
            'name'                  => $this->name,
            'brand'                 => $this->brand,
            'slug'                  => Str::slug($this->name),
            'price'                 => $this->price,
            'previous_price'        => $this->previous_price,
            'vat'                   => $this->vat,
            'category'              => $this->category,
            'quantity'              => $this->quantity,
            'manufacturer'          => $this->manufacturer,
            'description'           => $this->description,
            'money_back_days'       => $this->money_back,
            'warranty_period'       => $this->warranty,
            'active'                => ($this->active)? true: false,
        ]);

        // Upload the image
        foreach ($this->images as $image){
            $productImage = $image->store('/', 'images');
            ProductImage::create([
                'product_id'    =>  $product->id,
                'image'         => $productImage
            ]);
        }


        $this->emit('refreshProductList');
        $this->emit('close-current-modal');
        $this->resetExcept(['categories']);
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service update']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-product-form');
    }
}
