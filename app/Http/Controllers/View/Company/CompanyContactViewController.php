<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyContactViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function contacts (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Company contacts',
            'keywords' => 'Company contacts',
            'description' => 'Company contacts'
        ];
        return view('livewire.company.pages.company-contacts-list-page', ['data' => $data, 'settings'   => $this->settings, 'company' => $company]);
    }

    public function contactProfile ($contact){
        $contact = Contact::findOrFail($contact);
        $data = [
            'title' => $contact->lastname. '  ' .$contact->firstname ,
            'keywords' => 'Company contact',
            'description' => 'Company contact'
        ];
        return view('livewire.company.pages.company-contacts-info-page', ['data' => $data, 'contact' => $contact, 'settings'   => $this->settings]);
    }

}
