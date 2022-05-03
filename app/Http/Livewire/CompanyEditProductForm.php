<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditProductForm extends Component
{

    use WithFileUploads;
    public $product;

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
    public $image;

    public function mount($product){
        $this->product          = $product;
        $this->name             = $product->name;
        $this->brand            = $product->brand;
        $this->price            = $product->price;
        $this->previous_price   = $product->previous_price;
        $this->quantity         = $product->quantity;
        $this->category         = $product->category;
        $this->vat              = $product->vat;
        $this->currency         = $product->currency;
        $this->manufacturer     = $product->manufacturer;
        $this->description      = $product->description;
        $this->status           = $product->status;
        $this->money_back       = $product->money_back_days;
        $this->warranty         = $product->warranty_period;
        $this->active           = $product->active;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'name'                   => 'required|max:255',
            'brand'                  => 'required|max:255',
            'price'                  => 'required|numeric|min:1',
            'vat'                    => 'required|numeric|min:1|max:100',
            'quantity'               => 'required|numeric|min:1',
            'previous_price'         => 'required|numeric|min:1',
            'currency'               => 'nullable|string|max:23',
            'category'               => 'nullable|string|max:255',
            'manufacturer'           => 'required|string|max:255',
            'description'            => 'required|string|max:1000',
            'money_back'             => 'required|numeric|min:0',
            'warranty'               => 'required',
            'active'                 => 'nullable',
            'image'                  => 'nullable|image:mimes, jpeg, jpg, png',
        ]);
    }

    public function updateProduct(){
        $this->validate([
            'name'                   => 'required|max:255',
            'brand'                  => 'required|max:255',
            'price'                  => 'required|numeric|min:1',
            'vat'                    => 'required|numeric|min:1|max:100',
            'quantity'               => 'required|numeric|min:1',
            'previous_price'         => 'required|numeric|min:1',
            'currency'               => 'nullable|string|max:23',
            'category'               => 'nullable|string|max:255',
            'manufacturer'           => 'required|string|max:255',
            'description'            => 'required|string|max:1000',
            'money_back'             => 'required|numeric|min:0',
            'warranty'               => 'required',
            'active'                 => 'nullable',
            'image'                  => 'nullable|image:mimes, jpeg, jpg, png',
        ]);

        $productImage = false;
        if ($this->image){
            // Replace the old image
            $productImage = $this->image->store('/', 'images');
            // Delete product image
            File::delete($this->product->productImage);
        }

        Product::where('id', $this->product->id)->update([
            'updated_by'            => Auth::user()->id,
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
            'image'                 => ($productImage)?$productImage:$this->product->image
        ]);
        $this->emit('refreshProductDetails');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Product updated']);
    }


    public function update(){

    }

    public function render()
    {
        return view('livewire.company.components.company-edit-product-form');
    }
}
