<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyProductList extends Component
{
    public $products;
    public function mount($company){
        $this->products = $company->products;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-product-list');
    }
}
