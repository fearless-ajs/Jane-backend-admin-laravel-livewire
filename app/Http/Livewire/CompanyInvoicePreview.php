<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class CompanyInvoicePreview extends Component
{
    public $invoice;
    public $totalProductTax = 0.00;
    public $totalServiceTax = 0.00;


    public $settings;

    public function mount($invoice){
        $this->settings = Setting::first();
        $this->invoice = $invoice;



        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                $this->totalProductTax =  $this->totalProductTax + $product->total_tax;
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                $this->totalServiceTax =  $this->totalServiceTax + $service->total_tax;
            }
        }
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
