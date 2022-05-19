<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Worker;
use Illuminate\Http\Request;

class CompanyContactViewController extends Controller
{
    public function contacts (){
        $data = [
            'title' => 'Company contacts',
            'keywords' => 'Company contacts',
            'description' => 'Company contacts'
        ];
        return view('livewire.company.pages.company-contacts-list-page', ['data' => $data]);
    }

    public function contactProfile ($contact){
        $contact = Contact::findOrFail($contact);
        $data = [
            'title' => $contact->lastname. '  ' .$contact->firstname ,
            'keywords' => 'Company contact',
            'description' => 'Company contact'
        ];
        return view('livewire.company.pages.company-contacts-info-page', ['data' => $data, 'contact' => $contact]);
    }

}
