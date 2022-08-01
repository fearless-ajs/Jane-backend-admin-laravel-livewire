<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\InvoiceProvider;
use App\Traits\StripeServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    use InvoiceProvider;

    public function checkout()
    {
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

        return view('checkout.checkout',compact('intent'));

    }

    public function afterPayment()
    {
        echo 'Payment Received, Thanks you for using our services.';
    }

    public function createCustomer(){
        return $this->showMessage($this->createStripeCustomerAccount());
    }
    public function createStripeCustomerIntent(){
        $user = Auth::user();
        return $this->showMessage($this->setUpStripeCustomerIntent($user));
    }

    public function getStripeCustomerPaymentMethods(){
        $user = User::find(10);
        return $this->showMessage($this->fetchStripeCustomerPaymentMethods($user));
    }

    public function checkInvoices(){
       if ($this->checkForExpiredInvoices()){
           return $this->showMessage('Success', 200);
       }
    }

    public function sampleMail(){
      $this->sendSampleMail();
      return 'success';
    }
}
