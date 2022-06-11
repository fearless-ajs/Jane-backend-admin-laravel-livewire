<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCurrencyDetails extends Component
{
    public $currency;

    protected $listeners = [
      'refreshAdminCurrencyDetails' =>  '$refresh'
    ];

    public function mount($currency){
        $this->currency = $currency;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-currency-details');
    }
}
