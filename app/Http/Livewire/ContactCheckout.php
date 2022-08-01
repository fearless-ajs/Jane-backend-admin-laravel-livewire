<?php

namespace App\Http\Livewire;

use App\Mail\CartOrderEmailForContactMail;
use App\Models\ActiveService;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\CartOrderCatalogue;
use App\Models\CartTransaction;
use App\Models\ContactBillingAddress;
use App\Models\ContactPaymentMethod;
use App\Models\RecurringCataloguePaymentHistory;
use App\Traits\StripeServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactCheckout extends LiveNotify

{

    use StripeServiceProvider;

    public $cartCataloguesTotal = 0;
    public $cart;

    public $totalPrice;
    public $totalPriceWithTax;
    public $totalTax;

    public $card;

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
            $this->card= $card;
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

            if (count($this->cart->services) > 0){
                foreach ($this->cart->services as $item){
                    $itemTax = (($item->catalogue->tax->percentage / 100) * $item->catalogue->price);
                    $serviceTotalPrice = ($serviceTotalPrice + $item->catalogue->price);
                    $totalTax+=$itemTax;
                }
            }
        }

        $this->totalPrice        = $serviceTotalPrice + $productTotalPrice;
        $this->totalTax          = $totalTax;
        $this->totalPriceWithTax = $totalTax + $this->totalPrice;

//        dd($serviceTotalPrice);
        return true;
    }

    public function calculateCartCatalogues(){
        if ($this->cart){
            $this->cartCataloguesTotal = count($this->cart->products) + count($this->cart->services);
        }
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
        $user = Auth::user();
        $response = $this->makeStripeOnSessionPayment($user, $this->card->stripe_payment_id,$this->totalPriceWithTax * 100);
        if ($response->status == 'succeeded'){
            return $this->afterCartPayment();
        }
//        $this->makeStripeOffSessionPayment($user)
        return $this->alert('error', 'Payment error', 'Something went wrong with the payment, please check your card');
    }

    public function afterCartPayment()
    {
        $cart = Cart::findOrFail(Auth::user()->cart->id);

        // Create th order along with the status, calculate tax
        $cartOrder = CartOrder::create([
            'user_id'       =>  Auth::user()->id,
            'cart_id'       =>  $cart->id,
            'total_price'   =>  $cart->total_price,
            'total_paid'    =>  $cart->total_price,
            'fulfilled'     =>  false,
            'address'       =>  Auth::user()->billingAddress->address,
            'country'       =>  Auth::user()->billingAddress->country,
            'state'         =>  Auth::user()->billingAddress->state,
            'city'          =>  Auth::user()->billingAddress->city
        ]);

        if ($cart->services){
            foreach ($cart->services as $catalogue){
                $cartOrderCatalogue =  CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
                    'company_id'        => $catalogue->catalogue->company->id,
                    'total_price'       => $catalogue->total_service_price,
                    'type'              => 'service'
                ]);

                // Activate the services
                $activeRecord = ActiveService::create([
                    'user_id'                           => Auth::user()->id,
                    'catalogue_id'                      => $catalogue->catalogue->id,
                    'cart_order_catalogue_id'           => $cartOrderCatalogue->id,
                    'invoice_order_catalogue_id'        => null,
                    'active'                            => true
                ]);

                RecurringCataloguePaymentHistory::create([
                    'user_id'               =>  Auth::user()->id,
                    'catalogue_id'          =>  $catalogue->catalogue->id,
                    'active_service_id'     =>  $activeRecord->id,
                    'last_payment_date'     =>  Carbon::parse(Date::now()),
                    'last_payment_amount'   =>  $catalogue->total_service_price,
                    'next_due_date'         =>  ($catalogue->catalogue->cycle)?Carbon::parse(Date::now())->addDays($catalogue->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30)
                ]);
            }
        }

        if ($cart->products){
            foreach ($cart->products as $catalogue){
                CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
                    'company_id'        => $catalogue->catalogue->company->id,
                    'quantity'          => $catalogue->quantity,
                    'total_price'       => $catalogue->total_product_price,
                    'type'              => 'product'
                ]);

                $catalogue->catalogue->quantity = $catalogue->catalogue->quantity - $catalogue->quantity;
                $catalogue->catalogue->save();
            }
        }

        // Create the transaction history
        CartTransaction::create([
            'user_id'       =>  Auth::user()->id,
            'cart_id'       => $cart->id,
            'cart_order_id' => $cartOrder->id,
            'amount'        => $cart->total_price,
            'successful'    => true
        ]);


        $cart->checkout     = true;
        $cart->paid         = true;
        $cart->amount_paid  = $cart->total_price;
        $cart->payment_date = Carbon::parse(Date::now());
        $cart->save();


        // Mail the contact of the successful order
        $data = [
            'email_title'   => 'Order placed successfully',
            'user'          => $cart->user,
            'products'      => ($cart->products)?$cart->products:null,
            'services'      => ($cart->services)?$cart->services:null,
        ];


        try {
            retry(5, function () use ($data) {
                Mail::to($data['user']->email)->send(new CartOrderEmailForContactMail($data));
            });
        } catch (\Exception $e) {

        }

        // Mail the companies involved of the purchase(group_by company)
        $data = [
            'email_title'   => 'Order placed successfully',
            'user'          => $cart->user,
            'products'      => ($cart->products)?$cart->products:null,
            'services'      => ($cart->services)?$cart->services:null,
        ];



//        // Keep a record and manage services properly
//        if (count($cart->services) > 0) {
//            foreach ($cart->services as $service) {
//                RecurringCataloguePaymentHistory::create([
//                    'user_id'               =>  Auth::user()->id,
//                    'catalogue_id'          =>  $service->catalogue->id,
//                    'last_payment_date'     =>  Carbon::parse(Date::now()),
//                    'last_payment_amount'   =>  $service->total_price_with_tax,
//                    'next_due_date'         =>  ($service->catalogue->cycle)?Carbon::parse(Date::now())->addDays($service->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30)
//                ]);
//            }
//        }


        // Redirect to the orders page
        return redirect(route('contact.orders'))->with('message', 'Payment successful, your order will be processed immediately');
    }


    public function render()
    {
        return view('livewire.contact.components.contact-checkout');
    }
}
