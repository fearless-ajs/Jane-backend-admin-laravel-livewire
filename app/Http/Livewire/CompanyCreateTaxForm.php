<?php

namespace App\Http\Livewire;

use App\Models\CompanyTax;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyCreateTaxForm extends Component
{
    public $title;
    public $percentage;

    public function updated($field){
        $this->validateOnly($field, [
           'title'      =>  'required|string|max:255',
           'percentage' =>  'required|numeric|max:100'
        ]);
    }

    public function addPercentage(){
        $this->validate([
            'title'      =>  'required|string|max:255',
            'percentage' =>  'required|numeric|max:100'
        ]);

        CompanyTax::create([
            'company_id'    => Auth::user()->company->id,
            'title'         =>  $this->title,
            'percentage'    =>  $this->percentage
        ]);

        $this->emit('refreshCompanyTaxList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Taxes added']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-tax-form');
    }
}
