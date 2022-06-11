<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use Livewire\Component;

class AdminEditCurrencyForm extends Component
{
    public $currency;

    public $country;
    public $currency_name;
    public $currency_symbol;
    public $rate_to_dollar;


    public function mount($currency){
        $this->currency = $currency;
        $this->fetchFormData();
    }

    public function fetchFormData(){
        $this->country          = $this->currency->country;
        $this->currency_name    = $this->currency->currency_name;
        $this->currency_symbol  = $this->currency->currency_symbol;
        $this->rate_to_dollar   = $this->currency->rate_to_dollar;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'country'           => 'required|string',
            'currency_symbol'   => 'required|string|max:2',
            'currency_name'     => 'required|string|max:symbol',
            'rate_to_dollar'    => 'required|numeric'
        ]);
    }

    public function updateCurrency(){
        $this->validate([
            'country'           => 'required|string',
            'currency_symbol'   => 'required|string|max:2',
            'currency_name'     => 'required|string|max:symbol',
            'rate_to_dollar'    => 'required|numeric'
        ]);

        Currency::where('id', $this->currency->id)->update([
            'country'           => $this->country,
            'currency_symbol'   => $this->currency_symbol,
            'currency_name'     => $this->currency_name,
            'rate_to_dollar'    => $this->rate_to_dollar
        ]);

        $this->emit('refreshAdminCurrencyDetails');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Currency updated']);
    }

    public function render()
    {
        return view('livewire.admin.components.admin-edit-currency-form');
    }
}
