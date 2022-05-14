<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class CompanyInvoicePreview extends Component
{
    public $invoice;

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function download(){
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        set_time_limit(1300);
        $pdf = PDF::loadView('livewire.company.pages.company-invoice-print-page', ['data' => $data, 'invoice' => $this->invoice])->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('invoice.pdf');
    }

    public function render()
    {
        return view('livewire.company.components.company-invoice-preview');
    }
}
