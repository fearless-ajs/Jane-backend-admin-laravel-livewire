<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyProductList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshProductList' => '$refresh'];


    public function remove($product_id){
       $product =  Product::find($product_id);
       $product->delete();

       // Delete product image
       File::delete($product->productImage);
       $this->emit('refreshProductList');
       return $this->emit('alert', ['type' => 'success', 'message' => 'Product removed']);
    }

    public function render()
    {
        return view('livewire.company.components.company-product-list', [
            'products'  => Product::where('company_id', Auth::user()->company_id)->paginate(100)
        ]);
    }
}
