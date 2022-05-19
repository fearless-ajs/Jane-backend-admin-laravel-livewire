<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditContactForm extends Component
{
    use WithFileUploads;

    public $title;
    public $lastname;
    public $firstname;
    public $office_phone;
    public $mobile_phone;
    public $organization;
    public $fax;
    public $primary_email;
    public $date_of_birth;
    public $city;
    public $state;
    public $country;
    public $address;
    public $available;
    public $description;
    public $product = [];
    public $service = [];
    public $image;

    public $products;
    public $services;

    public $contact;
    public function mount($contact){
        $this->products = Product::where('company_id', Auth::user()->company_id)->get();
        $this->services = Service::where('company_id', Auth::user()->company_id)->get();

        $this->contact          = $contact;
        $this->title            = $contact->title;
        $this->lastname         = $contact->user->lastname;
        $this->firstname        = $contact->user->firstname;
        $this->office_phone     = $contact->office_phone;
        $this->mobile_phone     = $contact->mobile_phone;
        $this->organization     = $contact->organization;
        $this->fax              = $contact->fax;
        $this->primary_email    = $contact->user->email;
        $this->date_of_birth    = $contact->date_of_birth;
        $this->city             = $contact->city;
        $this->state            = $contact->state;
        $this->country          = $contact->country;
        $this->address          = $contact->address;
        $this->available        = $contact->available;
        $this->description      = $contact->description;

    }

    public function updated($field){
        $this->validateOnly($field, [
            'title'             => 'required|string|max:255',
            'office_phone'      => 'nullable',
            'mobile_phone'      => 'nullable',
            'organization'      => 'nullable',
            'fax'               => 'nullable|numeric',
            'date_of_birth'     => 'required|max:255',
            'product'           => 'nullable|array',
            'service'           => 'nullable|array',
            'city'              => 'required|string|max:255',
            'state'             => 'required|string|max:255',
            'country'           => 'required|string|max:255',
            'address'           => 'required|string|max:255',
            'description'       => 'required|string|max:1000',
            'available'         => 'nullable'
        ]);
    }

    public function updateContact(){
        $this->validate([
            'title'             => 'required|string|max:255',
            'office_phone'      => 'nullable',
            'mobile_phone'      => 'nullable',
            'organization'      => 'nullable',
            'fax'               => 'nullable|numeric',
            'date_of_birth'     => 'required|max:255',
            'product'           => 'nullable|array',
            'service'           => 'nullable|array',
            'city'              => 'required|string|max:255',
            'state'             => 'required|string|max:255',
            'country'           => 'required|string|max:255',
            'address'           => 'required|string|max:255',
            'description'       => 'required|string|max:1000',
            'available'         => 'nullable'
        ]);

        // Check if image exists
        if ($this->image){
            $this->image = $this->image->store('/', 'images');
            // Delete old image
            if ($this->contact->user->image != null && $this->contact->user->image != 'user-avatar.jpg'){
                // Delete product image
                File::delete($this->contact->user->userImage);
            }
        }

        $contact = Contact::where('id', $this->contact->id)->update([
            'title'             => $this->title,
            'office_phone'      => $this->office_phone,
            'mobile_phone'      => $this->mobile_phone,
            'organization'      => $this->organization,
            'fax'               => $this->fax,
            'date_of_birth'     => $this->date_of_birth,
            'city'              => $this->city,
            'state'             => $this->state,
            'country'           => $this->country,
            'address'           => $this->address,
            'description'       => $this->description,
            'available'         => ($this->available)?true:false
        ]);

        // Update user record too
//        User::where('id', $this->contact->user->id)->update([
//            'lastname'           => $this->lastname,
//            'firstname'          => $this->firstname,
//            'email'              => $this->primary_email,
//            'image'              => ($this->image)?$this->image:$this->contact->user->image,
//        ]);

        // Check for product and service and insert as transactions
        if (count($this->product) > 0){
            foreach ($this->product as $prod){
                Transaction::create([
                    'contact_id'     => $this->contact->id,
                    'company_id'     => Auth::user()->company_id,
                    'product_id'     => $prod
                ]);
            }
        }

        if (count($this->service) > 0){
            foreach ($this->service as $serv){
                Transaction::create([
                    'contact_id'     => $this->contact->id,
                    'company_id'     => Auth::user()->company_id,
                    'service_id'     => $serv
                ]);
            }
        }
        $this->reset(['product', 'service']);
        $this->emit('refreshContactProfile');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Contact updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-contact-form');
    }
}
