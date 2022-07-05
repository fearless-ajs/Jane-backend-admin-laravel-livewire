<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\CartOrderCatalogue;
use App\Models\CartTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutCart()
    {
        $data = [
            'title' => 'Make payment',
            'keywords' => 'Make payment',
            'description' => 'Make payment'
        ];
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));


        $amount = 100;
        $amount *= 100;
        $amount = (int) $amount;

        // Min amount is 100cent
        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Payment From All About Laravel',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('livewire.contact.pages.contact-pay-with-card',compact(['intent', 'data']));

    }

    public function afterCartPayment()
    {
        $cart = Cart::findOrFail(Auth::user()->cart->id);

        // Create th order along with the status, calculate tax
        $cartOrder = CartOrder::create([
            'user_id'       =>  Auth::user()->id,
            'cart_id'       =>  $cart->id,
            'total'         =>  $cart->total_price,
            'total_paid'    =>  $cart->total_price,
            'fulfilled'     =>  false,
            'address'       =>  Auth::user()->billingAddress->address,
            'country'       =>  Auth::user()->billingAddress->country,
            'state'         =>  Auth::user()->billingAddress->state,
            'city'          =>  Auth::user()->billingAddress->city
        ]);

        if ($cart->services){
            foreach ($cart->services as $catalogue){
                CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
                    'total_price'       => $catalogue->total_service_price
                ]);
            }
        }

        if ($cart->products){
            foreach ($cart->products as $catalogue){
                CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
                    'quantity'          => $catalogue->quantity,
                    'total_price'       => $catalogue->total_product_price
                ]);
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


        $cart->checkout = true;
        $cart->save();

        // Redirect to the orders page
        return redirect(route('contact.checkout'));
    }
}
