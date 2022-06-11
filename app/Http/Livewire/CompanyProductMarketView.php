<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyProductMarketView extends Component
{
    public $catalogue;
    public $missing;

    public function mount($catalogue, $missing){
        $this->catalogue = $catalogue;
        $this->missing = $missing;
    }

    public function render()
    {
        return view('livewire.company.components.company-product-market-view');
    }
}
