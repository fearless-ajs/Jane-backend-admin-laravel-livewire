<?php


namespace App\Traits;




use App\Models\Setting;
use App\Models\User;

trait StripeServiceProvider
{
    public function createStripeCustomerAccount(){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey(getEnv('STRIPE_SECRET'));

        return \Stripe\Customer::create();

    }

    public function setUpStripeCustomerIntent($user){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(getEnv('STRIPE_SECRET'));

       return $stripe->setupIntents->create(
            [
                'customer' => $user->stripe_customer_id,
                'payment_method_types' => ['card'],
            ]
        );
    }

    public function fetchStripeCustomerPaymentMethods($user){
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(getEnv('STRIPE_SECRET'));

       return $stripe->paymentMethods->all(
            ['customer' => $user->stripe_customer_id, 'type' => 'card']
        );
    }

    public function makeStripeOffSessionPayment($user, $payment_method, $amount){
         $settings = Setting::first();
        // Set your secret key. Remember to switch to your live secret key in production.

        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey(getEnv('STRIPE_SECRET'));

//        dd($payment_method);
    try {
           $payment =  \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => $settings->currency->currency_name,
                'customer' => $user->stripe_customer_id,
                'payment_method' => $payment_method,
                'off_session' => true,
                'confirm' => true,
            ]);

           return $payment;
        } catch (\Stripe\Exception\CardException $e) {
            // Error code will be authentication_required if authentication is needed
//            echo 'Error code is:' . $e->getError()->code;
            $payment_intent_id = $e->getError()->payment_intent->id;
            $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

            // Mail the user that an error occurred and they should login to renew the
            // service manually

            return $payment_intent;
        }
    }

    public function makeStripeOnSessionPayment($user, $payment_method_id, $amount){
        $settings = Setting::first();
        // Set your secret key. Remember to switch to your live secret key in production.

        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey(getEnv('STRIPE_SECRET'));

//        dd($payment_method);
        try {
            $payment =  \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => $settings->currency->currency_name,
                'customer' => $user->stripe_customer_id,
                'payment_method' => $payment_method_id,
                'off_session' => true,
                'confirm' => true,
            ]);

            return $payment;
        } catch (\Stripe\Exception\CardException $e) {
            // Error code will be authentication_required if authentication is needed
//            echo 'Error code is:' . $e->getError()->code;
            $payment_intent_id = $e->getError()->payment_intent->id;
            $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

            // Mail the user that an error occurred and they should login to renew the
            // service manually

            return $payment_intent;
        }
    }

    public function detachCardFromCustomer($card_stripe_id){
        $stripe = new \Stripe\StripeClient(
            getEnv('STRIPE_SECRET')
        );
        $stripe->paymentMethods->detach(
            $card_stripe_id
            []
        );
    }
}
