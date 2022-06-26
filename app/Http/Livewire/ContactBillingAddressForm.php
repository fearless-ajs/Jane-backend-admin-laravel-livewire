<?php

namespace App\Http\Livewire;

use App\Models\ContactBillingAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactBillingAddressForm extends Component
{


    public $fullname;
    public $phone;
    public $email;
    public $vat;
    public $tax_id;
    public $city;
    public $state;
    public $country;
    public $address;
    public $zip;

    public $billingAddress;

    public function mount(){
        $billingAddress = ContactBillingAddress::where('user_id', Auth::user()->id)->first();
        if ($billingAddress){
            $this->billingAddress = $billingAddress;
            $this->fullname = $billingAddress->fullname;
            $this->phone    = $billingAddress->phone;
            $this->email    = $billingAddress->email;
            $this->vat      = $billingAddress->vat;
            $this->tax_id   = $billingAddress->tax_id;
            $this->city     = $billingAddress->city;
            $this->state    = $billingAddress->state;
            $this->country  = $billingAddress->country;
            $this->address  = $billingAddress->address;
            $this->zip      = $billingAddress->zip;
        }else{
            $billingAddress =  ContactBillingAddress::create([
                'user_id'           => Auth::user()->id,
                'fullname'          => Auth::user()->lastname. '  ' .Auth::user()->firstname,
                'email'             => Auth::user()->email,
            ]);

            $this->billingAddress = $billingAddress;
            $this->fullname = $billingAddress->fullname;
            $this->phone    = $billingAddress->phone;
            $this->email    = $billingAddress->email;
            $this->vat      = $billingAddress->vat;
            $this->tax_id   = $billingAddress->tax_id;
            $this->city     = $billingAddress->city;
            $this->state    = $billingAddress->state;
            $this->country  = $billingAddress->country;
            $this->address  = $billingAddress->address;
            $this->zip      = $billingAddress->zip;
        }

    }

    public function updated($field){
        $this->validateOnly($field, [
           'fullname'       =>  'required|string|max:255',
           'phone'          =>  'required|numeric',
           'email'          =>  'required|email|max:255',
           'vat'            =>  'required|string|max:255',
           'tax_id'         =>  'required|string|max:255',
           'city'           =>  'required|string|max:255',
           'state'          =>  'required|string|max:255',
           'country'        =>  'required|string|max:255',
           'address'        =>  'required|string|max:255',
           'zip'            =>  'required|string|max:255'
        ]);
    }

    public function save(){
        $this->validate([
            'fullname'       =>  'required|string|max:255',
            'phone'          =>  'required|numeric',
            'email'          =>  'required|email|max:255',
            'vat'            =>  'nullable|string|max:255',
            'tax_id'         =>  'nullable|string|max:255',
            'city'           =>  'required|string|max:255',
            'state'          =>  'required|string|max:255',
            'country'        =>  'required|string|max:255',
            'address'        =>  'required|string|max:255',
            'zip'            =>  'required|string|max:255'
        ]);

        $this->billingAddress->update([
            'fullname'          => $this->fullname,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'vat'               => $this->vat,
            'tax_id'            => $this->tax_id,
            'city'              => $this->city,
            'state'             => $this->state,
            'country'           => $this->country,
            'address'           => $this->address,
            'zip'               => $this->zip
        ]);

        return $this->emit('alert', ['type' => 'success', 'message' => 'Billing address saved']);
    }

    public function render()
    {
        return view('livewire.contact.components.contact-billing-address-form');
    }
}
