<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyInvoicePrint extends Component
{
    public $invoice;

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.company.components.company-invoice-print');
    }
}
