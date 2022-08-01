<?php

namespace App\Http\Livewire;

use App\Models\ContactPaymentMethod;
use App\Models\RecurringCataloguePaymentHistory;
use App\Traits\EmailProvider;
use App\Traits\StripeServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Livewire\Component;

class ContactSubscriptionDetails extends LiveNotify
{
    use StripeServiceProvider, EmailProvider;

    protected $listeners  = [
      'refreshSubscription' => '$refresh',
      'delete'              => 'cancel'
    ];

    public $item;
    public $history;
    public $card;

    public function mount($sub){
        $this->item = $sub;

        $this->history = RecurringCataloguePaymentHistory::where('user_id', $this->item->user_id)
            ->where('catalogue_id', $this->item->catalogue_id)
            ->where('active_service_id', $this->item->id)
            ->where('charge_attempted', false)
            ->first();

        $this->fetchPaymentMethod();
    }


    public function fetchPaymentMethod(){
        $this->card = ContactPaymentMethod::where('user_id', Auth::user()->id)->first();
    }

    public function cancelService(){
        $this->confirmDelete('warning', 'Do you want to cancel this service?', 'Press ok to continue', $this->item->id);
    }

    public function cancel($item_id){
        $this->item->active = false;
        $this->item->save();

        // Create transaction history as a later feature

        // Mail the user of the success status
        $this->sendRecurringBillingStatusToContactEmail($this->history->user, $this->history, 'SERVICE CANCELLED SUCCESSFULLY',
            $this->history->catalogue->name . " service has been cancelled successfully, thanks for using our service"
        );

        $this->emit('refreshSubscription');
        return $this->alert('success', 'Service cancelled', 'Press ok to continue');
    }

    public function resumeService(){
        $user  = Auth::user();
        $amount = ($this->item->catalogue->tax)?(($this->item->catalogue->tax->percentage / 100 ) * $this->item->catalogue->price) + $this->item->catalogue->price: $this->item->catalogue->price;

        $response = $this->makeStripeOnSessionPayment($user, $this->card->stripe_payment_id, $amount*100);

        if ($response->status == 'succeeded'){
            $this->history->charge_attempted         = true;
            $this->history->charge_attempt_status    = 'succeeded';
            $this->history->amount_charged           = $response->amount_received / 100;
            $this->history->save();

            // Create the next billing cycle
            RecurringCataloguePaymentHistory::create([
                'active_service_id'      =>  $this->history->active_service_id,
                'user_id'                =>  $this->history->user_id,
                'catalogue_id'           =>  $this->history->catalogue_id,
                'last_payment_date'      =>  Carbon::parse(Date::now()),
                'last_payment_amount'    =>  $response->amount_received / 100,
                'next_due_date'          =>  ($this->history->catalogue->cycle)?Carbon::parse(Date::now())->addDays($this->history->catalogue->cycle->days):Carbon::parse(Date::now())->addDays(30),
                'active'                 =>  true
            ]);

            $this->item->active = true;
            $this->item->save();

            // Create transaction history as a later feature

            // Mail the user of the success status
            $this->sendRecurringBillingStatusToContactEmail($this->history->user, $this->history, 'SERVICE RENEWED SUCCESSFULLY',
                $this->history->catalogue->name . " service has been renewed successfully"
            );

            $this->emit('refreshSubscription');
           return $this->alert('success', 'Payment successful', 'Press ok to continue');
        }

        return $this->alert('error', 'Payment error', 'Please make sure you have enough cash in your account');
    }

    public function render()
    {
        return view('livewire.contact.components.contact-subscription-details');
    }
}
