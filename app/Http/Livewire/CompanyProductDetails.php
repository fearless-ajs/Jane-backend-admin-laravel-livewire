<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyProductDetails extends Component
{

    public $product;
    protected $listeners = ['refreshProductDetails' => '$refresh'];

    public function mount($product){
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.company.components.company-product-details');
    }
}
