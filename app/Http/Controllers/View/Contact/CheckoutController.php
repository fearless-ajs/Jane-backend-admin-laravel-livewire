<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Create the transaction history

        // Create th order along with the status

        // Redirect to the orders page
        return redirect(route('contact.checkout'));
    }
}
