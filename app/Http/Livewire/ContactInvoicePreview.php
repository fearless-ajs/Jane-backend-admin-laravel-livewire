<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Unicodeveloper\Paystack\Facades\Paystack;


class ContactInvoicePreview extends Component
{
    public $invoice;
    public $signaturePad;
    public $settings;

    public $totalProductTax = 0.00;
    public $totalServiceTax = 0.00;

    protected $listeners = [
      'refreshContactInvoicePreview'     =>  '$refresh'
    ];

    public function showSignaturePad(){
        $this->signaturePad = true;
    }

    public function mount($invoice){
        $this->invoice = $invoice;
        $this->settings = Setting::first();


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

    public function makePayment(){
        // Redirect to donation payment type page
        $reference = Paystack::genTranxRef();

        $amount = ($this->invoice->products_total_price + $this->totalProductTax) + ($this->invoice->services_total_price + $this->totalServiceTax);

        // Enter the details of the payment
        $data = [
            "amount"    => 20,
            "reference" => $reference,
            "email"     => Auth::user()->email,
            "currency"  => $this->settings->currency->currency_name,
            "orderID"   => 23456,
            "quantity"  => 1
        ];

        $payment = Paystack::getAuthorizationUrl($data)->redirectNow();;

        if ($payment['status'] !== 'success') {
            // notify something went wrong
//            dd($payment);
            return redirect()->back()->with('status',"Unable to complete transaction");
        }

        return redirect($payment['data']['link']);
    }

    public function render()
    {
        return view('livewire.contact.components.contact-invoice-preview');
    }
}
