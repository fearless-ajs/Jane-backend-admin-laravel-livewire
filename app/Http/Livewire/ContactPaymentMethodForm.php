<?php

namespace App\Http\Livewire;

use App\Models\ContactPaymentMethod;
use App\Traits\StripeServiceProvider;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Livewire\Component;

class ContactPaymentMethodForm extends LiveNotify
{
    use StripeServiceProvider;

    public $encryptedCardNumber;

    public $primaryCard;
    public $intent;

    public $paymentMethods = [];

    protected $listeners = [
      'refreshContactPaymentMethod'     =>  '$refresh',
       'delete'                         =>  'delete'
    ];

    public function mount(){
//        $this->encryptedCardNumber = $this->stringToSecret($this->card_number);
        $this->intent = Auth::user()->intent;

       $methods = $this->fetchStripePaymentMethods();
       $this->paymentMethods = $methods->data;
        $this->fetchPrimaryCardInfo();
    }


    public function fetchStripePaymentMethods(){
        // Check for a payment method

        // If one set it as primary

        return $this->fetchStripeCustomerPaymentMethods(Auth::user());
    }

    public function fetchPrimaryCardInfo(){
        $card = ContactPaymentMethod::where('user_id', Auth::user()->id)->first();
        if ($card){
            $this->primaryCard = $card;
        }else{
            if (count($this->paymentMethods) > 0 && count($this->paymentMethods) == 1){
               $this->primaryCard = ContactPaymentMethod::create([
                   'user_id'    =>  Auth::user()->id,
                   'stripe_payment_id'  => $this->paymentMethods[0]->id
                ]);
            }
        }

    }

    public function removeCard($card_stripe_id){
        return $this->confirmDelete('warning','Do you want to delete', 'Press ok to continue', $card_stripe_id);
    }

    public function delete($card_stripe_id){
        $this->detachCardFromCustomer($card_stripe_id);
        if ($card_stripe_id == $this->primaryCard->stripe_payment_id){
            $this->primaryCard->delete();
        }

        $this->paymentMethods = [];
        return $this->alert('success', 'Payment method delete', 'Press ok to continue');

    }

    public function testOffSessionPayment(){
        if (count($this->paymentMethods) > 0){
            $user = Auth::user();
            $paymentMethod = $this->paymentMethods[0];
            $response = $this->makeStripeOffSessionPayment($user, $paymentMethod, 3000);

            dd($response);
        }

        return $this->emit('alert', ['type' => 'error', 'message' => 'You have no payment method']);
    }

    public function save(){
//        $this->validate([
//            'card_number'    =>  ['required', new CardNumber],
//            'name'           =>  'required|string|max:255',
//            'exp'            =>  'required|string',
//            'cvv'            =>  'required|numeric'
//        ]);
//
//
//        $this->card->update([
//            'card_number'    =>  $this->card_number,
//            'name_on_card'   =>  $this->name,
//            'exp'            =>  $this->exp,
//            'cvv'            =>  $this->cvv
//        ]);

        $this->emit('refreshContactPaymentMethod');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Payment card saved']);
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

    public function render()
    {
        return view('livewire.contact.components.contact-payment-method-form');
    }
}
