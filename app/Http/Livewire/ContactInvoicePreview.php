<?php

namespace App\Http\Livewire;

use App\Mail\InvoiceOrderEmailForCompanyMail;
use App\Mail\InvoiceOrderEmailForContactMail;
use App\Models\ActiveService;
use App\Models\ContactPaymentMethod;
use App\Models\Invoice;
use App\Models\InvoiceOrder;
use App\Models\InvoiceOrderCatalogue;
use App\Models\InvoiceTransaction;
use App\Models\RecurringCataloguePaymentHistory;
use App\Models\Setting;
use App\Traits\StripeServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Unicodeveloper\Paystack\Facades\Paystack;


class ContactInvoicePreview extends LiveNotify
{
    use StripeServiceProvider;

    public $invoice;
    public $signaturePad;
    public $settings;

    public $totalProductTax = 0.00;
    public $totalServiceTax = 0.00;


    public $card;


    protected $listeners = [
      'refreshContactInvoicePreview'     =>  '$refresh'
    ];

    public function showSignaturePad(){
        $this->signaturePad = true;
    }

    public function mount($invoice){
        $this->invoice = $invoice;
        $this->settings = Setting::first();


        if (count($invoice->products) > 0){
            foreach ($invoice->products as $product){
                $this->totalProductTax =  $this->totalProductTax + $product->total_tax;
            }
        }

        if (count($invoice->services) > 0){
            foreach ($invoice->services as $service){
                $this->totalServiceTax =  $this->totalServiceTax + $service->total_tax;
            }
        }

        $this->fetchCardInfo();
    }

    public function fetchCardInfo(){
        $card = ContactPaymentMethod::where('user_id', Auth::user()->id)->first();
        if ($card){
            $this->card= $card;
        }
    }

    public function makePayment(){
        $user = Auth::user();
        $response = $this->makeStripeOnSessionPayment($user, $this->card->stripe_payment_id,($this->totalProductTax + $this->totalServiceTax) * 100);
        if ($response->status == 'succeeded'){
            return $this->afterInvoicePayment();
        }
//        $this->makeStripeOffSessionPayment($user)
        return $this->alert('error', 'Payment error', 'Something went wrong with the payment, please check your card');
    }

    public function afterInvoicePayment()
    {
        $totalProductTax = 0.00;
        $totalServiceTax = 0.00;
        $invoice = Invoice::find($this->invoice->id);

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
                    'company_id'        => $product->catalogue->company->id,
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
                $invoiceOrderCatalogue = InvoiceOrderCatalogue::create([
                    'invoice_order_id'  => $invoiceOrder->id,
                    'catalogue_id'      => $service->catalogue->id,
                    'quantity'          => $service->quantity,
                    'company_id'        => $service->catalogue->company->id,
                    'delivered'         => false,
                    'type'              => 'service',
                    'total_price'       => $service->total_price_with_tax
                ]);

                // Activate the services
                $activeService = ActiveService::create([
                    'user_id'                        => Auth::user()->id,
                    'catalogue_id'                   => $service->catalogue->id,
                    'invoice_order_catalogue_id'     => $invoiceOrderCatalogue->id,
                    'cart_order_catalogue_id'        => null,
                    'active'                         => true
                ]);

                RecurringCataloguePaymentHistory::create([
                    'user_id'               =>  Auth::user()->id,
                    'catalogue_id'          =>  $service->catalogue->id,
                    'active_service_id'     =>  $activeService->id,
                    'last_payment_date'     =>  Carbon::parse(Date::now()),
                    'last_payment_amount'   =>  $service->total_price_with_tax,
                    'next_due_date'         =>  ($service->catalogue->cycle)?Carbon::parse(Date::now())->addDays($service->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30)
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
//        if (count($invoice->services) > 0) {
//            foreach ($invoice->services as $service) {
//                RecurringCataloguePaymentHistory::create([
//                    'user_id'               =>  Auth::user()->id,
//                    'catalogue_id'          =>  $service->catalogue->id,
//                    'last_payment_date'     =>  Carbon::parse(Date::now()),
//                    'last_payment_amount'   =>  $service->total_price_with_tax,
//                    'next_due_date'         =>  ($service->catalogue->cycle)?Carbon::parse(Date::now())->addDays($service->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30)
//                ]);
//            }
//        }


        // Mail the contact of the successful order
        $data = [
            'email_title'   => 'Invoice payment successful',
            'user'          =>  $invoice->contact->user,
            'invoice_id'    =>  $invoice->id,
            'products'      => ($invoice->products)?$invoice->products:null,
            'services'      => ($invoice->services)?$invoice->services:null,
            'total_paid'    => $totalProductTax + $totalServiceTax
        ];

        Mail::to($data['user']->email)->send(new InvoiceOrderEmailForContactMail($data));

        try {
            retry(5, function () use ($data) {

            });
        } catch (\Exception $e) {

        }

        // Mail the companies involved of the purchase(group_by company)
        $data = [
            'email_title'   => 'Invoice payment made',
            'contact'       =>  $invoice->contact,
            'date_issued'   =>  $invoice->date_issued,
            'invoice_id'    =>  $invoice->id,
            'worker'        =>  $invoice->worker,
            'products'      =>  ($invoice->products)?$invoice->products:null,
            'services'      =>  ($invoice->services)?$invoice->services:null,
            'total_paid'    =>  $totalProductTax + $totalServiceTax
        ];

        Mail::to($data['worker']->email)->send(new InvoiceOrderEmailForCompanyMail($data));

        try {
            retry(5, function () use ($data) {

            });
        } catch (\Exception $e) {

        }

        // Redirect to invoice preview page;
        return redirect(route('contact.invoices-preview', $invoice->id))->with('message', 'Payment successful, your order will be processed immediately.');
    }

    public function render()
    {
        return view('livewire.contact.components.contact-invoice-preview');
    }
}
