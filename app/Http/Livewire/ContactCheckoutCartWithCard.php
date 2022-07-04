<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactCheckoutCartWithCard extends Component
{
    public $intent;
    public $totalPrice;
    public $totalPriceWithTax;
    public $totalTax;

    public $cart;

    public function mount($intent){
        $this->intent = $intent;
        $this->cart = Auth::user()->cart;
        $this->calculateTotalPrice();
    }

    public function calculateTotalPrice(){
        $serviceTotalPrice = 0;
        $productTotalPrice = 0;
        $totalTax = 0.00;


        if ($this->cart){
            if (count($this->cart->products) > 0){
                foreach ($this->cart->products as $item){
                    $itemTotal = $item->catalogue->price * $item->quantity;
                    if ($item->catalogue->tax){
                        $itemTax = (($item->catalogue->tax->percentage / 100) * $item->catalogue->price) * $item->quantity;
                        $productTotalPrice = $productTotalPrice+$itemTotal;
                        $totalTax+=$itemTax;
                    }else{
                        $productTotalPrice = $productTotalPrice+$itemTotal;
                    }
                }
            }

            if (count($this->cart->products) > 0){
                foreach ($this->cart->services as $item){
                    $itemTax = (($item->catalogue->tax->percentage / 100) * $item->catalogue->price);
                    $serviceTotalPrice = $serviceTotalPrice+$serviceTotalPrice + $item->catalogue->price;
                    $totalTax+=$itemTax;
                }
            }
        }

        $this->totalPrice        = $serviceTotalPrice + $productTotalPrice;
        $this->totalTax          = $totalTax;
        $this->totalPriceWithTax = $totalTax + $this->totalPrice;
        return true;
    }

    public function render()
    {
        return view('livewire.contact.components.contact-checkout-cart-with-card');
    }
}
