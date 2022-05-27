<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class CompanyInvoicePrint extends Component
{
    public $invoice;

    public $settings;

    public function mount($invoice){
        $this->settings = Setting::first();
        $this->invoice = $invoice;
    }
    public function render()
    {
        return view('livewire.company.components.company-invoice-print');
    }
}
