<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\CartOrderCatalogue;
use App\Models\CartTransaction;
use App\Models\Invoice;
use App\Models\InvoiceOrder;
use App\Models\InvoiceOrderCatalogue;
use App\Models\InvoiceTransaction;
use App\Models\RecurringCataloguePaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
                CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
                    'total_price'       => $catalogue->total_service_price,
                    'type'              => 'service'
                ]);
            }
        }

        if ($cart->products){
            foreach ($cart->products as $catalogue){
                CartOrderCatalogue::create([
                    'cart_order_id'     => $cartOrder->id,
                    'catalogue_id'      => $catalogue->catalogue->id,
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

        // Redirect to the orders page
        return redirect(route('contact.orders'))->with('message', 'Payment successful, your order will be processed immediately');
    }


    public function checkoutInvoice($invoice_id)
    {
        $totalProductTax = 0.00;
        $totalServiceTax = 0.00;
        $totalPrice = 0.00;
        $invoice = Invoice::find($invoice_id);

        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                $totalProductTax =  $totalProductTax + $product->total_price_with_tax;
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                $totalServiceTax =  $totalServiceTax + $service->total_price_with_tax;
            }
        }

        $totalPrice = $totalServiceTax + $totalProductTax;

        $invoice  = Invoice::find($invoice_id);

        $data = [
            'title' => 'Make payment',
            'keywords' => 'Make payment',
            'description' => 'Make payment'
        ];
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET'));


        $amount = $totalPrice;
        $amount *= 100;
        $amount = (int) $amount;
//
//        dd($amount);

        // Min amount is 100cent
        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Invoice payment',
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Invoice payment',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('livewire.contact.pages.contact-pay-invoice-with-card', ['intent' => $intent, 'data' => $data, 'invoice' => $invoice]);

    }

    public function afterInvoicePayment(Request $request)
    {
        $totalProductTax = 0.00;
        $totalServiceTax = 0.00;
        $invoice = Invoice::find($request->invoice);

        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                $totalProductTax =  $totalProductTax + $product->total_price_with_tax;
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                $totalServiceTax =  $totalServiceTax + $service->total_price_with_tax;
            }
        }


        // Create th order along with the status, calculate tax
        $invoiceOrder = InvoiceOrder::create([
            'user_id'       =>  Auth::user()->id,
            'invoice_id'    =>  $invoice->id,
            'total_price'   =>  $totalProductTax + $totalServiceTax,
            'total_paid'    =>  $totalProductTax + $totalServiceTax,
            'fulfilled'     =>  false,
            'address'       =>  Auth::user()->billingAddress->address,
            'country'       =>  Auth::user()->billingAddress->country,
            'state'         =>  Auth::user()->billingAddress->state,
            'city'          =>  Auth::user()->billingAddress->city
        ]);


        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                InvoiceOrderCatalogue::create([
                    'invoice_order_id'     => $invoiceOrder->id,
                    'catalogue_id'      => $product->catalogue->id,
                    'quantity'          => $product->quantity,
                    'delivered'         => false,
                    'type'              => 'product',
                    'total_price'       => $product->total_price_with_tax
                ]);

                $product->catalogue->quantity = $product->catalogue->quantity - $product->quantity;
                $product->catalogue->save();
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                InvoiceOrderCatalogue::create([
                    'invoice_order_id'  => $invoiceOrder->id,
                    'catalogue_id'      => $service->catalogue->id,
                    'quantity'          => $service->quantity,
                    'delivered'         => false,
                    'type'              => 'product',
                    'total_price'       => $service->total_price_with_tax
                ]);
            }
        }

        // Create the transaction history
        InvoiceTransaction::create([
            'user_id'          =>  Auth::user()->id,
            'invoice_id'       => $invoice->id,
            'invoice_order_id' => $invoiceOrder->id,
            'amount'           => $totalProductTax + $totalServiceTax,
            'successful'       => true
        ]);

        $invoice->paid = true;
        $invoice->amount_paid = $totalProductTax + $totalServiceTax;
        $invoice->payment_date  = Carbon::parse(Date::now());
        $invoice->save();

        // Create a recurring records for services
        if (count($invoice->services) > 0) {
            foreach ($invoice->services as $service) {
                RecurringCataloguePaymentHistory::create([
                    'user_id'               =>  Auth::user()->id,
                    'catalogue_id'          =>  $service->catalogue->id,
                    'last_payment_date'     =>  Carbon::parse(Date::now()),
                    'last_payment_amount'   =>  $service->total_price_with_tax,
                    'next_due_date'         =>  ($service->catalogue->cycle)?Carbon::parse(Date::now())->addDays($service->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30)
                ]);
            }
        }

        // Redirect to invoice preview page;
        return redirect(route('contact.invoices-preview', $invoice->id))->with('message', 'Payment successful, your order will be processed immediately.');
    }
}
