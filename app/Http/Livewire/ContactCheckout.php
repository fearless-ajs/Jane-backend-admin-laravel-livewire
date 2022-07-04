<?php

namespace App\Http\Livewire;

use App\Models\ContactBillingAddress;
use App\Models\ContactPaymentMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactCheckout extends Component

{

    public $cartCataloguesTotal = 0;
    public $cart;

    public $totalPrice;
    public $totalPriceWithTax;
    public $totalTax;

    public $card;
    public $encryptedCardNumber;
    public $card_number;
    public $name;
    public $exp;
    public $cvv;

    public $fullname;
    public $phone;
    public $email;
    public $vat;
    public $tax_id;
    public $city;
    public $state;
    public $country;
    public $address;
    public $zip;

    public $billingAddress;

    protected $listeners = [
        'refreshMyCartPage'     => 'fetchCart'
    ];

    public function mount(){
        $this->fetchCart();
        $this->fetchBillingAddressInfo();
        $this->fetchCardInfo();
        $this->encryptedCardNumber = $this->stringToSecret($this->card_number);
    }


    public function fetchBillingAddressInfo(){
        $billingAddress = ContactBillingAddress::where('user_id', Auth::user()->id)->first();
        if ($billingAddress){
            $this->billingAddress = $billingAddress;
            $this->fullname = $billingAddress->fullname;
            $this->phone    = $billingAddress->phone;
            $this->email    = $billingAddress->email;
            $this->vat      = $billingAddress->vat;
            $this->tax_id   = $billingAddress->tax_id;
            $this->city     = $billingAddress->city;
            $this->state    = $billingAddress->state;
            $this->country  = $billingAddress->country;
            $this->address  = $billingAddress->address;
            $this->zip      = $billingAddress->zip;
        }else{
            $billingAddress =  ContactBillingAddress::create([
                'user_id'           => Auth::user()->id,
                'fullname'          => Auth::user()->lastname. '  ' .Auth::user()->firstname,
                'email'             => Auth::user()->email,
            ]);

            $this->billingAddress = $billingAddress;
            $this->fullname = $billingAddress->fullname;
            $this->phone    = $billingAddress->phone;
            $this->email    = $billingAddress->email;
            $this->vat      = $billingAddress->vat;
            $this->tax_id   = $billingAddress->tax_id;
            $this->city     = $billingAddress->city;
            $this->state    = $billingAddress->state;
            $this->country  = $billingAddress->country;
            $this->address  = $billingAddress->address;
            $this->zip      = $billingAddress->zip;
        }

    }

    public function fetchCardInfo(){
        $card = ContactPaymentMethod::where('user_id', Auth::user()->id)->first();
        if ($card){
            $this->card         = $card;
            $this->card_number  = $card->card_number;
            $this->name         = $card->name_on_card;
            $this->exp          = $card->exp;
            $this->cvv          = $card->cvv;
        }else{
            $card = ContactPaymentMethod::create([
                'user_id'       =>  Auth::user()->id,
                'name_on_card'  =>  Auth::user()->lastname. ' ' . Auth::user()->firstname,
                'card_number'   =>  0000000000000000,
                'exp'           =>  '12/23',
                'cvv'           =>  000
            ]);

            $this->card         = $card;
            $this->card_number  = $card->card_number;
            $this->name         = $card->name_on_card;
            $this->exp          = $card->exp;
            $this->cvv          = $card->cvv;
        }
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

    private function stringToSecret(string $string = NULL)
    {
        if (!$string) {
            return NULL;
        }
        $length = strlen($string);
        $visibleCount = (int) round($length / 4);
        $hiddenCount = $length - ($visibleCount * 2);
        return substr($string, 0, $visibleCount) . str_repeat('*', $hiddenCount) . substr($string, ($visibleCount * -1), $visibleCount);
    }

    public function saveBillingAddress(){
        $this->validate([
            'fullname'       =>  'required|string|max:255',
            'phone'          =>  'required|numeric',
            'email'          =>  'required|email|max:255',
            'vat'            =>  'nullable|string|max:255',
            'tax_id'         =>  'nullable|string|max:255',
            'city'           =>  'required|string|max:255',
            'state'          =>  'required|string|max:255',
            'country'        =>  'required|string|max:255',
            'address'        =>  'required|string|max:255',
            'zip'            =>  'required|string|max:255'
        ]);

        $this->billingAddress->update([
            'fullname'          => $this->fullname,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'vat'               => $this->vat,
            'tax_id'            => $this->tax_id,
            'city'              => $this->city,
            'state'             => $this->state,
            'country'           => $this->country,
            'address'           => $this->address,
            'zip'               => $this->zip
        ]);

        return $this->emit('alert', ['type' => 'success', 'message' => 'Billing address saved']);
    }

    public function makePayment(){


        return $this->emit('alert', ['type' => 'success', 'message' => 'Payment successful']);
    }

    public function render()
    {
        return view('livewire.contact.components.contact-checkout');
    }
}
