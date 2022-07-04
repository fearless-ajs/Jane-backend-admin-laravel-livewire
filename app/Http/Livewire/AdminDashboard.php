<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Contact;
use App\Models\Invoice;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $companies;
    public $companiesCount;
    public $contacts;
    public $catalog;
    public $invoices;

    public function mount(){
        $this->companiesCount   = Company::all();
        $this->companies        = Company::orderBy('id', 'DESC')->limit(5)->get();
        $this->contacts         = Contact::all();
        $this->catalog          = CompanyCatalogue::all();
        $this->invoices         = Invoice::all();
    }

    public function render()
    {
        return view('livewire.admin.components.admin-dashboard');
    }
}
