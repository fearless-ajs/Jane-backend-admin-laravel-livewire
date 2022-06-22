<?php

namespace App\Http\Livewire;

use App\Models\CompanyTax;
use Livewire\Component;

class CompanyEditTaxForm extends Component
{
    public $title;
    public $percentage;

    public $tax;

    protected $listeners = ['editTax'  => 'parseFormParameters'];

    public function parseFormParameters($taxId)
    {
        $tax = CompanyTax::find($taxId);
        if ($tax){
            $this->tax          = $tax;
            $this->title        = $tax->title;
            $this->percentage   = $tax->percentage;
        }
    }

    public function updated($field){
        $this->validateOnly($field, [
            'title'      =>  'required|string|max:255',
            'percentage' =>  'required|numeric|max:100'
        ]);
    }

    public function updatePercentage(){
        $this->validate([
            'title'      =>  'required|string|max:255',
            'percentage' =>  'required|numeric|max:100'
        ]);

        $this->tax->update([
           'title'          =>  $this->title,
           'percentage'     =>  $this->percentage
        ]);

        $this->emit('refreshCompanyTaxList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Taxes updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-tax-form');
    }
}
