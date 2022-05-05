<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyInvoicePreview extends Component
{
    public $invoice;

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.company.components.company-invoice-preview');
    }
}
