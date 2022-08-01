<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\CompanyCatalogue;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyCart extends Component
{
    public $cartCataloguesTotal = 0;
    public $cart;

    public $totalPrice;

    protected $listeners = [
        'refreshMyCart'     => 'fetchCart'
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

        if ($this->cart){
            if (count($this->cart->products) > 0){
                foreach ($this->cart->products as $item){
                    $productTotalPrice = $productTotalPrice + $item->total_product_price;
                }
            }

            if (count($this->cart->services) > 0){
                foreach ($this->cart->services as $item){
                    $serviceTotalPrice = $serviceTotalPrice + $item->total_service_price;
                }
            }
        }

        $this->totalPrice = $serviceTotalPrice + $productTotalPrice;
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
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        if($cartItem){
            if (($cartItem->quantity + 1) > $catalogue->quantity){
                return $this->emit('alert', ['type' => 'warning', 'message' => 'Cannot add above available quantity']);
            }

            $cartItem->quantity += 1;

            // Calculate product new price with tax
            if ($cartItem->catalogue->tax){
                $cartItem->total_product_price = $cartItem->total_product_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                $cart->total_price  = $cart->total_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);

            }else{
                $cartItem->total_product_price = $cartItem->total_product_price + $catalogue->price;
                $cart->total_price  = $cart->total_price + $catalogue->price;;
            }

            $cartItem->save();
            $cart->save();
        }
        $this->emit('refreshMyCart');
        $this->emit('refreshMyCartPage');
    }

    public function removeItem($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $cartItem = CartProduct::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        if($cartItem){

            if ($cartItem->quantity - 1 == 0){
                // Calculate product new price with tax
                if ($cartItem->catalogue->tax){
                    $cart->total_price  = $cart->total_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                }else{
                    $cart->total_price  = $cart->total_price - $catalogue->price;
                }
                $cartItem->delete();
            }else{
                if ($cartItem->catalogue->tax){
                    $cartItem->total_product_price = $cartItem->total_product_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                    $cart->total_price  = $cart->total_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);

                }else{
                    $cartItem->total_product_price = $cartItem->total_product_price - $catalogue->price;
                    $cart->total_price  = $cart->total_price - $catalogue->price;
                }

                $cartItem->quantity-=1;
                $cartItem->save();
            }

            $cart->save();
        }
        $this->emit('refreshMyCart');
        $this->emit('refreshMyCartPage');
        $this->emit('refreshCompanyCatalogueList');
        $this->emit('refreshContactCatalogueDetails');
    }

    public function removeService($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $cartItem = CartService::where('cart_id', $this->cart->id)->where('catalogue_id', $catalogue->id)->first();
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        if ($cartItem){
            if ($cartItem->catalogue->tax){
                $cart->total_price  = $cart->total_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
            }else{
                $cart->total_price  = $cart->total_price - $catalogue->price;
            }
            $cartItem->delete();
        }
        $this->emit('refreshMyCart');
        $this->emit('refreshMyCartPage');
        $this->emit('refreshCompanyCatalogueList');
        $this->emit('refreshContactCatalogueDetails');
    }

    public function render()
    {
        return view('livewire.contact.components.my-cart');
    }
}
