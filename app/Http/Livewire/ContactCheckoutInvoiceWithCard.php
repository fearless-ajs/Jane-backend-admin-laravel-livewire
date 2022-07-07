<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class ContactCheckoutInvoiceWithCard extends Component
{
    public $signaturePad;
    public $settings;

    public $invoice;
    public $intent;

    public $totalProductTax = 0.00;
    public $totalServiceTax = 0.00;

    protected $listeners = [
        'refreshContactInvoicePreview'     =>  '$refresh'
    ];

    public function showSignaturePad(){
        $this->signaturePad = true;
    }

    public function mount($invoice, $intent){
        $this->invoice = $invoice;
        $this->intent  = $intent;
        $this->settings = Setting::first();


        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                $this->totalProductTax =  $this->totalProductTax + $product->total_price_with_tax;
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                $this->totalServiceTax =  $this->totalServiceTax + $service->total_price_with_tax;
            }
        }
    }

    public function render()
    {
        return view('livewire.contact.components.contact-checkout-invoice-with-card');
    }
}
