<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactInvoicePreview extends Component
{
    public $invoice;
    public $signaturePad;

    protected $listeners = [
      'refreshContactInvoicePreview'     =>  '$refresh'
    ];

    public function showSignaturePad(){
        $this->signaturePad = true;
    }

    public function mount($invoice){
        $this->invoice = $invoice;
    }

    public function render()
    {
        return view('livewire.contact.components.contact-invoice-preview');
    }
}
