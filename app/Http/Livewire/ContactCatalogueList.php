<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Setting;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactCatalogueList extends Component
{
    use WithPagination;
    use FileManager;

    protected $listeners = ['refreshCompanyCatalogueList' => '$refresh'];
    public $settings;
    public $company;

    public $search;
    public $searchResult;

    public $order;

    public $categories;
    public $category;

    public function mount(){
        $this->settings = Setting::first();
        $this->company = Company::find(Auth::user()->company_id);
        $this->categories   =   Category::all();
    }



    public function updated(){
        if ($this->search){
            if ($this->order){
                if ($this->category){
                    $this->searchResult = CompanyCatalogue::orderBy('price', $this->order)
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::orderBy('price', $this->order)->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }else{
                if ($this->category){

                    $this->searchResult = CompanyCatalogue::where('name', 'LIKE', "%{$this->search}%")->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }
        }

    }

    public function addProductToCart($catalogue_id){
        $catalogue = CompanyCatalogue::findOrFail($catalogue_id);

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


    public function removeProductFromCart($catalogue_id){
        $catalogue = CompanyCatalogue::findOrFail($catalogue_id);
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

    public function clearFilter(){
        $this->category = null;
        $this->search = null;
        $this->searchResult = null;
        $this->order    = null;
    }


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.contact.components.contact-catalogue-list', [
                'catalogues' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            if ($this->category){
                if ($this->order){
                    return view('livewire.contact.components.contact-catalogue-list', [
                        'catalogues' => CompanyCatalogue::where('category', $this->category)->orderBy('price', $this->order)->paginate(12)
                    ]);
                }else{
                    return view('livewire.contact.components.contact-catalogue-list', [
                        'catalogues' => CompanyCatalogue::where('category', $this->category)->paginate(12)
                    ]);
                }
            }else{
                return view('livewire.contact.components.contact-catalogue-list', [
                    'catalogues' => CompanyCatalogue::paginate(12)
                ]);
            }
        }
    }
}
