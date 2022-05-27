<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class CompanyProductDetails extends Component
{

    public $product;
    protected $listeners = ['refreshProductDetails' => '$refresh'];

    public function mount($product){
        $this->product = Product::find($product->id);
    }

    public function removeImage($productImageId){
       $image = ProductImage::find($productImageId);

       // Prevent from deleting last Image
        if (count($image->product->images) <= 1){
            return   $this->emit('alert', ['type' => 'error', 'message' => 'You cannot delete the last product image']);
        }

       // remove product image
        File::delete($this->product->productImage);

        $image->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Product image deleted']);
        return  $this->emit('refreshProductDetails');
    }

    public function render()
    {
        return view('livewire.company.components.company-product-details');
    }
}
