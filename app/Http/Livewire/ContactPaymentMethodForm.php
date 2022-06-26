<?php

namespace App\Http\Livewire;

use App\Models\ContactPaymentMethod;
use Illuminate\Support\Facades\Auth;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Livewire\Component;

class ContactPaymentMethodForm extends Component
{
    public $card_number;
    public $name;
    public $exp;
    public $cvv;

    public $encryptedCardNumber;

    public $card;

    protected $listeners = [
      'refreshContactPaymentMethod'     =>  '$refresh'
    ];

    public function mount(){
        $this->fetchCardInfo();
        $this->encryptedCardNumber = $this->stringToSecret($this->card_number);
    }



    public function fetchCardInfo(){
        $card = ContactPaymentMethod::where('user_id', Auth::user()->id)->first();
        if ($card){
            $this->card         = $card;
            $this->card_number  = $card->card_number;
            $this->name         = $card->name_on_card;
            $this->exp          = $card->exp;
            $this->cvv          = $card->cvv;
        }else{
            $card = ContactPaymentMethod::create([
                'user_id'       =>  Auth::user()->id,
                'name_on_card'  =>  Auth::user()->lastname. ' ' . Auth::user()->firstname,
                'card_number'   =>  0000000000000000,
                'exp'           =>  '12/23',
                'cvv'           =>  000
            ]);

            $this->card         = $card;
            $this->card_number  = $card->card_number;
            $this->name         = $card->name_on_card;
            $this->exp          = $card->exp;
            $this->cvv          = $card->cvv;
        }
    }

    public function updated($field){
        $this->validateOnly($field, [
           'card_number'    =>  ['required', new CardNumber],
           'name'           =>  'required|string|max:255',
           'exp'            =>  'required|string',
           'cvv'            =>  'required|numeric'
        ]);
    }


    public function save(){
        $this->validate([
            'card_number'    =>  ['required', new CardNumber],
            'name'           =>  'required|string|max:255',
            'exp'            =>  'required|string',
            'cvv'            =>  'required|numeric'
        ]);


        $this->card->update([
            'card_number'    =>  $this->card_number,
            'name_on_card'   =>  $this->name,
            'exp'            =>  $this->exp,
            'cvv'            =>  $this->cvv
        ]);

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
