<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyInvoicePreview extends Component
{
    public $invoice;
    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-invoice-preview');
    }
}
