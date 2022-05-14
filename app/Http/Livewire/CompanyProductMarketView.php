<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyProductMarketView extends Component
{
    public $product;
    public $missing;

    public function mount($product, $missing){
        $this->product = $product;
        $this->missing = $missing;
    }

    public function render()
    {
        return view('livewire.company.components.company-product-market-view');
    }
}
