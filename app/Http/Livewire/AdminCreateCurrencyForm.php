<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use Livewire\Component;

class AdminCreateCurrencyForm extends Component
{
    public $country;
    public $currency_name;
    public $currency_symbol;
    public $rate_to_dollar;


    public function updated($field){
        $this->validateOnly($field, [
            'country'           => 'required|string',
            'currency_symbol'   => 'required|string|max:2',
            'currency_name'     => 'required|string|max:symbol',
            'rate_to_dollar'    => 'required|numeric'
        ]);
    }

    public function addCurrency(){
        $this->validate([
            'country'           => 'required|string',
            'currency_symbol'   => 'required|string|max:2',
            'currency_name'     => 'required|string|max:symbol',
            'rate_to_dollar'    => 'required|numeric'
        ]);

        Currency::create([
            'country'           => $this->country,
            'currency_symbol'   => $this->currency_symbol,
            'currency_name'     => $this->currency_name,
            'rate_to_dollar'    => $this->rate_to_dollar
        ]);

        $this->emit('refreshAdminCurrencyList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Currency added to the system']);
    }


    public function render()
    {
        return view('livewire.admin.components.admin-create-currency-form');
    }
}
