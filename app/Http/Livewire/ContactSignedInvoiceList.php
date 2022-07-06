<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactSignedInvoiceList extends Component
{
    use WithPagination;


    public $contact;

    public $contactRecords;

    public $company;

    public $invoices = [];


    public function mount(){
        $this->contactRecords = Auth::user()->Contacts;
        $this->fetchDefaultInvoiceRecords();
    }

    public function updated(){
        if ($this->contact){
            $contact = Contact::find($this->contact);
            $this->invoices = Invoice::orderBy('due_date', 'ASC')->where('signed', true)->where('contact_id', $contact->id)->where('company_id', $contact->company->id)->get();
        }
    }

    public function fetchDefaultInvoiceRecords(){
        $contact = $this->contactRecords->first();
        $this->contact = $contact->id;
        $this->invoices = Invoice::orderBy('due_date', 'ASC')->where('signed', true)->where('contact_id', $contact->id)->where('company_id', $contact->company->id)->get();
    }


    public function render()
    {
        return view('livewire.contact.components.contact-signed-invoice-list');
    }
}
