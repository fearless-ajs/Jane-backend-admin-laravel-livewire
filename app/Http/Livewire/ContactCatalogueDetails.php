<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\CompanyCatalogue;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;

class ContactCatalogueDetails extends Component
{
    public $catalogue;
    public $isPresentInCart;


    protected $listeners = [
        'refreshContactCatalogueDetails'     =>  '$refresh'
    ];

    public function mount($catalogue){
        $this->catalogue = $catalogue;
        $this->fetchCatalogue();
    }

    public function checkCatalogueInCart(){
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
        if ($cart){
            if ($this->catalogue->type == 'service'){
                $service = CartService::where('cart_id', $cart->id)->where('catalogue_id', $this->catalogue->id)->first();
                if ($service){
                    $this->isPresentInCart = true;
                }
            }
            if ($this->catalogue->type == 'product'){
                $service = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $this->catalogue->id)->first();
                if ($service){
                    $this->isPresentInCart = true;
                }
            }
        }
    }

    public function fetchCatalogue(){
        $this->catalogue = CompanyCatalogue::find($this->catalogue->id);
        $this->checkCatalogueInCart();
    }


    public function addProductToCart(){
        $catalogue = CompanyCatalogue::findOrFail($this->catalogue->id);

        if ($catalogue->type == 'product'){
            // If cart doesn't exist
            $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
            if(!$cart){

                // Create cart
                $cart = Cart::create([
                    'user_id'        => auth()->user()->id,
                    'checkout'       => false,
                    'total_price'    => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);

                // Check if the product quantity is available
                if ($catalogue->quantity < 1){
                    return $this->emit('alert', ['type' => 'error', 'message' => 'The product does not have enough quantity']);
                }
                // Create cart product
                CartProduct::create([
                    'cart_id'               => $cart->id,
                    'catalogue_id'          => $catalogue->id,
                    'quantity'              => 1,
                    'total_product_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);
            }else{
                // If cart already exist
                $cartProduct = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $catalogue->id)->first();
                if ($cartProduct){
                    // Update the cart product
                    $cartProduct->update([
                        'quantity'             => $cartProduct->quantity + 1,
                        'total_product_price' => ($catalogue->tax)?((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price) * ($cartProduct->quantity + 1):  $catalogue->price * ($cartProduct->quantity + 1),
                    ]);
                    // Update the cart total price
                    if ($catalogue->tax){
                        $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price) * ($cartProduct->quantity + 1);
                    }else{
                        $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ($catalogue->price * ($cartProduct->quantity + 1));
                    }
                    $cart->save();
                }else{
                    CartProduct::create([
                        'cart_id'               => $cart->id,
                        'catalogue_id'            => $catalogue->id,
                        'quantity'              => 1,
                        'total_product_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                    ]);

                    if ($catalogue->tax){
                        $cart->total_price  = $cart->total_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);

                    }else{
                        $cart->total_price  = $cart->total_price + $catalogue->price;;
                    }
                    $cart->save();
                }
            }
        }else if ($catalogue->type == 'service'){
            $this->addServiceToCart($catalogue);
        }

        $this->isPresentInCart = true;
        $this->emit('refreshContactCatalogueDetails');
        $this->emit('refreshMyCart');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Added to cart']);
    }

    public function addServiceToCart($catalogue){
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
        if(!$cart){
            // Create cart
            $cart = Cart::create([
                'user_id'        => auth()->user()->id,
                'checkout'       => false,
                'total_price'    => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
            ]);
            // Create cart product
            CartService::create([
                'cart_id'                 => $cart->id,
                'catalogue_id'            => $catalogue->id,
                'total_service_price'     => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
            ]);
        }else{
            // If cart already exist
            $cartService = CartService::where('cart_id', $cart->id)->where('catalogue_id', $catalogue->id)->first();
            if (!$cartService){
                CartService::create([
                    'cart_id'                 => $cart->id,
                    'catalogue_id'            => $catalogue->id,
                    'total_service_price'     => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);

                if ($catalogue->tax){
                    $cart->total_price  = $cart->total_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                }else{
                    $cart->total_price  = $cart->total_price + $catalogue->price;
                }
                $cart->save();
            }
        }
    }


    public function removeProductFromCart(){
        $catalogue = CompanyCatalogue::findOrFail($this->catalogue->id);
        if ($catalogue->type == 'product'){
            // If cart doesn't exist
            $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
            $cartProduct = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $catalogue->id)->first();

            // Update cart total price
            $cart->total_price = $cart->total_price - $cartProduct->total_product_price;

            // Delete product from cart
            $cartProduct->delete();
            $cart->save();

        }else if ($catalogue->type == 'service'){
            $this->removeServiceFromCart($catalogue);
        }

        $this->isPresentInCart = false;
        $this->emit('refreshContactCatalogueDetails');
        $this->emit('refreshMyCart');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Removed from cart']);
    }

    public function removeServiceFromCart($catalogue){
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
        $cartService = CartService::where('cart_id', $cart->id)->where('catalogue_id', $catalogue->id)->first();

        // Update cart total price
        $cart->total_price = $cart->total_price - $cartService->total_service_price;

        // Delete service from cart
        $cartService->delete();
        $cart->save();
    }



    public function render()
    {
        return view('livewire.contact.components.contact-catalogue-details');
    }
}
