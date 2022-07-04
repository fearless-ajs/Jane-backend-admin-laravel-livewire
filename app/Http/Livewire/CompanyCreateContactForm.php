<?php

namespace App\Http\Livewire;

use App\Mail\ContactUserAccountCreationMail;
use App\Models\Company;
use App\Models\Contact;
use App\Models\ContactBillingAddress;
use App\Models\ContactPaymentMethod;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyCreateContactForm extends Component
{
    use WithFileUploads, FileManager;

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


    public $company;

    public function mount($company){
        $this->company = $company;
//        $this->products = Product::where('company_id', $this->company->id)->get();
//        $this->services = Service::where('company_id', $this->company->id)->get();
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
            'primary_email'     => 'required|string|email',
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
            'primary_email'     => 'required|string|email',
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
            $this->image = $this->saveUserAvatar($this->image, 'images');
        }

        // Check if the email exist in the users table and ignore creation
        $user = User::where('email', $this->primary_email)->first();
        if (!$user){
            $user = User::create([
                'lastname'           => $this->lastname,
                'firstname'          => $this->firstname,
                'email'              => $this->primary_email,
                'user_type'          => 'contact',
                'image'              => ($this->image)?$this->image:null,
                'password'           => $this->lastname
            ]);

            // Attach customer role to the user
            $user->attachRole('customer');


            // Mail the user concerning the account creation and "crmcode" as password
            Mail::to($user->email)->send(new ContactUserAccountCreationMail($user, $this->company));
        }

        if (!$user->hasRole('customer')){
            $user->attachRole('customer');
        }

        $contact = Contact::create([
            'company_id'        => $this->company->id,
            'user_id'           => $user->id,
            'lastname'          => $this->lastname,
            'firstname'         => $this->firstname,
            'email'             => $this->primary_email,
            'image'             => ($this->image)?$this->image:null,
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

        // Create payment information if it doesn't exist
        $billingAddress = ContactBillingAddress::where('user_id', $user->id)->first();
        if (!$billingAddress){
            ContactBillingAddress::create([
                'user_id'           => $user->id,
                'fullname'          => $this->lastname. '  ' .$this->firstname,
                'email'             => $this->primary_email,
                'phone'             => $this->mobile_phone,
                'city'              => $this->city,
                'state'             => $this->state,
                'country'           => $this->country,
                'address'           => $this->address,
            ]);
        }
        $paymentMethod = ContactPaymentMethod::where('user_id', $user->id)->first();
        if (!$paymentMethod){
            ContactPaymentMethod::create([
                'user_id'           => $user->id,
                'name_on_card'      =>  $user->lastname. ' ' . $user->firstname,
                'card_number'       =>  0000000000000000,
                'exp'               =>  '12/23',
                'cvv'               =>  000
            ]);
        }


        // Check for product and service and insert as transactions
        if (count($this->product) > 0){
            foreach ($this->product as $prod){
                Transaction::create([
                    'contact_id'     => $contact->id,
                    'company_id'     => $this->company->id,
                    'product_id'     => $prod
                ]);
            }
        }

        if (count($this->service) > 0){
            foreach ($this->service as $serv){
                Transaction::create([
                    'contact_id'     => $contact->id,
                    'company_id'     => $this->company->id,
                    'service_id'     => $serv
                ]);
            }
        }

        $this->resetExcept(['products', 'services', 'company']);
        $this->emit('refreshContactList');
        $this->emit('refreshAdminContactList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Contact created']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-contact-form');
    }

}
