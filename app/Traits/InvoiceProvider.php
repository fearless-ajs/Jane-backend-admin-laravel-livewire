<?php


namespace App\Traits;


use App\Mail\SampleMail;
use App\Models\CartOrderCatalogue;
use App\Models\ContactPaymentMethod;
use App\Models\InvoiceOrderCatalogue;
use App\Models\RecurringCataloguePaymentHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

trait InvoiceProvider
{
    use StripeServiceProvider, EmailProvider;

    public function checkForExpiredInvoices(){
        $recurringInvoiceOrderCatalogues   = InvoiceOrderCatalogue::where('type', 'service')->where('pipeline', '!=', 'cancelled')->get();
        $recurringCartOrderCatalogues      = CartOrderCatalogue::where('type', 'service')->where('pipeline', '!=', 'cancelled')->get();

        // Check for invoice order catalogues
        if (count($recurringInvoiceOrderCatalogues) > 0){
            foreach ($recurringInvoiceOrderCatalogues as $item){
                // Check if the item is a service
                if ($item->type === 'service'){
                    // Check for the billing cycle
                    if ($item->catalogue && $item->catalogue->cycle && $item->invoiceOrder){
                        // Check the last renewal date
                        $paymentHistory = RecurringCataloguePaymentHistory::where('user_id', $item->invoiceOrder->user_id)->where('charge_attempted', false)->where('catalogue_id', $item->catalogue->id)->first();
                        if ($paymentHistory){
                            // Check for due dates
                            $this->initiateAutoBilling($paymentHistory, $item);
                        }
                    }
                }
            }
        }

        // Check for cart order catalogues
        if (count($recurringCartOrderCatalogues) > 0){
            foreach ($recurringCartOrderCatalogues as $item){
                // Check if the item is a service
                if ($item->type === 'service'){
                    // Check for the billing cycle
                    if ($item->catalogue && $item->catalogue->cycle && $item->cartOrder){
                        // Check the last renewal date
                        $paymentHistory = RecurringCataloguePaymentHistory::where('user_id', $item->cartOrder->user_id)->where('charge_attempted', false)->where('catalogue_id', $item->catalogue->id)->first();
                        if ($paymentHistory){
                            $this->initiateAutoBilling($paymentHistory, $item);
                        }
                    }
                }
            }
        }

        return true;

    }


    public function initiateAutoBilling($paymentHistory, $item){

        if (($paymentHistory->next_due_date <= Carbon::parse(Date::now()))){
            // Check if catalogue still exists
            if ($paymentHistory->catalogue){
                $user = $paymentHistory->user;
                $paymentMethod = $this->fetchUserPaymentInfo($paymentHistory->user);
                if ($paymentMethod){
                    $amount = ($paymentHistory->catalogue->tax)? (($paymentHistory->catalogue->tax->percentage / 100 ) * $paymentHistory->catalogue->price) + $paymentHistory->catalogue->price: $paymentHistory->catalogue->price;
                    // Attempt to charge user

                    $response = $this->makeStripeOffSessionPayment($user, $paymentMethod->stripe_payment_id, $amount * 100);
                    if ($response->status == 'succeeded'){
                        $paymentHistory->charge_attempted         = true;
                        $paymentHistory->charge_attempt_status   = 'succeeded';
                        $paymentHistory->amount_charged          = $response->amount_received / 100;
                        $paymentHistory->save();

                        // Create the next billing cycle
                        RecurringCataloguePaymentHistory::create([
                            'active_service_id'      =>  $paymentHistory->active_service_id,
                            'user_id'                =>  $paymentHistory->user_id,
                            'catalogue_id'           =>  $paymentHistory->catalogue_id,
                            'last_payment_date'      =>  Carbon::parse(Date::now()),
                            'last_payment_amount'    =>  $response->amount_received / 100,
                            'next_due_date'          =>  ($paymentHistory->catalogue->cycle)?Carbon::parse(Date::now())->addDays($paymentHistory->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30),
                            'active'                 =>  true
                        ]);

                        // Create transaction history as a later feature

                        // Mail the user of the success status
                        $this->sendRecurringBillingStatusToContactEmail($paymentHistory->user, $paymentHistory, 'SERVICE RENEWED SUCCESSFULLY',
                            $paymentHistory->catalogue->name . " service has been renewed successfully"
                        );


                    }else{
                        $paymentHistory->charge_attemped        = true;
                        $paymentHistory->charge_attempt_status  = 'failed';
                        $paymentHistory->save();

                        // Create transaction history as a later feature

                        // Deactivate the service
                        $paymentHistory->activeService->active = false;
                        $paymentHistory->activeService->save();

                        $item->pipeline = 'cancelled';
                        $item->save();


                        // Mail the user of the charge failure
                        $this->sendRecurringBillingStatusToContactEmail($paymentHistory->user, $paymentHistory, 'SERVICE RENEWED SUCCESSFULLY',
                            $paymentHistory->catalogue->name . " service renewal failed, you can retry making payment through your dashboard to continue enjoying the service"
                        );
                    }
                }
            }

        }else{
            $due_date_timestamp          = $paymentHistory->next_due_date->timestamp;
            $last_payment_date_timestamp = $paymentHistory->last_payment_date->timestamp;
            $current_date_timestamp      = Carbon::parse(Date::now())->timestamp;

            $cycle                       = $due_date_timestamp - $last_payment_date_timestamp;
            $last_payment_date_till_now  = $due_date_timestamp - $current_date_timestamp;

            $eighty_percent_due_date     = (80 / 100 ) * $cycle;

            if ($last_payment_date_till_now >= $eighty_percent_due_date){
                // Mail the user of the success status
                $this->sendRecurringBillingStatusToContactEmail($paymentHistory->user, $paymentHistory, 'SERVICE RENEWAL NOTICE',
                    "Your ". $paymentHistory->catalogue->name . " Service will soon expire and be renewed automatically " .$paymentHistory->next_due_date->diffForHumans() . "time,
                you will be charged automatically from your primary card in order for you to continue enjoying the service, Thanks for choosing us"
                );
            }
        }
    }





    public function fetchUserPaymentInfo($user){
        $card = ContactPaymentMethod::where('user_id', $user->id)->first();
        if ($card){
           return $card;
        }

        return false;
    }

    public function generateInvoice(){

    }

    public function chargeContact(){
        $stripe = new \Stripe\StripeClient(
            getEnv('STRIPE_SECRET')
        );

      return $stripe->charges->create([
            'amount' => 2000,
            'currency' => 'usd',
            'source' => 'tok_visa',
            'description' => 'My First Test Charge (created for API docs at https://www.stripe.com/docs/api)',
        ]);

    }

    public function sendSampleMail(){

        $user = User::first();
        $data = [
            'user'          => $user,
            'email_title'   => 'sample title',
            'message'       => 'Sample mail'
        ];
        error_log('got here too');

        Mail::to($user->email)->send(new SampleMail($data));
    }

}

