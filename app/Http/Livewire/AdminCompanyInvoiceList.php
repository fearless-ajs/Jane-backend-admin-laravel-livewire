<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyInvoiceList extends Component
{
    public $invoices;

    public function mount($company){
        $this->invoices  = $company->invoices;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-invoice-list');
    }
}
