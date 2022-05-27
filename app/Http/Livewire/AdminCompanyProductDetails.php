<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AdminCompanyProductDetails extends Component
{
    public $product;
    public $settings;

    public function mount($product){
        $this->settings = Setting::first();
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-product-details');
    }
}
