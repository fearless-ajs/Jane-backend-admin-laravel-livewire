<?php

namespace App\Http\Livewire;

use App\Mail\ContactUserAccountCreationMail;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyCreateContactForm extends Component
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


    public function mount(){
        $this->products = Product::where('company_id', Auth::user()->company_id)->get();
        $this->services = Service::where('company_id', Auth::user()->company_id)->get();
    }

    public function updated($field){
        $this->validateOnly($field, [
            'title'             => 'required|string|max:255',
            'lastname'          => 'required|string|max:255',
            'firstname'         => 'required|string|max:255',
            'office_phone'      => 'nullable',
            'mobile_phone'      => 'nullable',
            'organization'      => 'nullable',
            'fax'               => 'nullable|numeric',
            'primary_email'     => 'required|string|email|',
            'date_of_birth'     => 'required|max:255',
            'product'           => 'nullable|array',
            'service'           => 'nullable|array',
            'image'             => 'nullable|image',
            'city'              => 'required|string|max:255',
            'state'             => 'required|string|max:255',
            'country'           => 'required|string|max:255',
            'address'           => 'required|string|max:255',
            'description'       => 'required|string|max:1000',
            'available'         => 'nullable'
        ]);
    }

    public function addContact(){
        $this->validate([
            'title'             => 'required|string|max:255',
            'lastname'          => 'required|string|max:255',
            'firstname'         => 'required|string|max:255',
            'office_phone'      => 'nullable',
            'mobile_phone'      => 'nullable',
            'organization'      => 'nullable',
            'fax'               => 'nullable|numeric',
            'primary_email'     => 'required|string|email|',
            'date_of_birth'     => 'required|max:255',
            'product'           => 'nullable|array',
            'service'           => 'nullable|array',
            'image'             => 'nullable|image',
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
        }

        // Check if the email exist in the users table and ignore creation
        $user = User::where('email', $this->primary_email)->first();
        if (!$user){
            $user = User::create([
                'lastname'           => $this->lastname,
                'firstname'          => $this->firstname,
                'email'              => $this->primary_email,
                'user_type'          => 'Company-worker',
                'image'              => ($this->image)?$this->image:null,
                'password'           => 'crmcode'
            ]);

            // Attach customer role to the user
            $user->attachRole('customer');

            // fetch the company details
            $company = Company::find(Auth::user()->company_id);

            // Mail the user concerning the account creation and "crmcode" as password
            Mail::to($user->email)->send(new ContactUserAccountCreationMail($user, $company));
        }

        if (!$user->hasRole('customer')){
            $user->attachRole('customer');
        }

        $contact = Contact::create([
            'created_by_id'     => Auth::user()->id,
            'company_id'        => Auth::user()->company_id,
            'user_id'           => $user->id,
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

        // Check for product and service and insert as transactions
        if (count($this->product) > 0){
            foreach ($this->product as $prod){
                Transaction::create([
                    'contact_id'     => $contact->id,
                    'company_id'     => Auth::user()->company_id,
                    'product_id'     => $prod
                ]);
            }
        }

        if (count($this->service) > 0){
            foreach ($this->service as $serv){
                Transaction::create([
                    'contact_id'     => $contact->id,
                    'company_id'     => Auth::user()->company_id,
                    'service_id'     => $serv
                ]);
            }
        }

        $this->resetExcept(['products', 'services']);
        $this->emit('refreshContactList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Contact created']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-contact-form');
    }

}
