<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactPaymentInfoForm extends Component
{
    public $paymentMethod;
    public $billingAddress;

    public function showPaymentMethod(){
        $this->billingAddress = false;
        $this->paymentMethod  = true;
    }

    public function showBillingAddress(){
        $this->paymentMethod  = false;
        $this->billingAddress = true;
    }

    public function mount(){
        $this->showPaymentMethod();
    }

    public function render()
    {
        return view('livewire.contact.components.contact-payment-info-form');
    }
}
