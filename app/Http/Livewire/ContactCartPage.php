<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\CompanyCatalogue;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactCartPage extends Component
{
    public $cartCataloguesTotal = 0;
    public $cart;

    public $totalPrice;
    public $totalPriceWithTax;
    public $totalTax;

    protected $listeners = [
        'refreshMyCartPage'     => 'fetchCart'
    ];

    public function mount(){
        $this->fetchCart();
    }

    public function fetchCart(){
        $this->cart = Auth::user()->cart;
        $this->calculateCartCatalogues();
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

    public function calculateCartCatalogues(){
        if ($this->cart){
            $this->cartCataloguesTotal = count($this->cart->products) + count($this->cart->services);
        }
    }

    public function addItem($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $cartItem = CartProduct::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
        if($cartItem){
            if (($cartItem->quantity + 1) > $catalogue->quantity){
                return $this->emit('alert', ['type' => 'warning', 'message' => 'Cannot add above available quantity']);
            }
            $cartItem->quantity+=1;
            $cartItem->save();
        }
        $this->emit('refreshMyCart');
        $this->emit('refreshMyCartPage');
    }

    public function removeItem($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $cartItem = CartProduct::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
        if($cartItem){
            if ($cartItem->quantity - 1 == 0){
                $cartItem->delete();
            }else{
                $cartItem->quantity-=1;
                $cartItem->save();
            }
        }
        $this->emit('refreshMyCart');
        $this->emit('refreshMyCartPage');
        $this->emit('refreshCompanyCatalogueList');
        $this->emit('refreshContactCatalogueDetails');
    }

    public function removeCatalogue($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        if ($catalogue->type == 'product'){
            $cartItem = CartProduct::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
            if ($cartItem){

                $cartItem->delete();
            }
        }

        if ($catalogue->type == 'service'){
            $cartItem = CartService::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
            if ($cartItem){
                $cartItem->delete();
            }
        }

        $this->emit('refreshMyCart');
        $this->emit('refreshCompanyCatalogueList');
        $this->emit('refreshContactCatalogueDetails');
        $this->emit('refreshMyCartPage');
    }


    public function render()
    {
        return view('livewire.contact.components.contact-cart-page');
    }
}
