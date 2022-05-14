<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyProductDetails extends Component
{
    public $product;

    public function mount($product){
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-product-details');
    }
}
