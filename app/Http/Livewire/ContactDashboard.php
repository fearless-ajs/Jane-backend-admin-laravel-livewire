<?php

namespace App\Http\Livewire;

use App\Models\CompanyCatalogue;
use App\Models\Invoice;
use Livewire\Component;

class ContactDashboard extends Component
{
    public $signedInvoices = [];
    public $unsignedInvoices = [];
    public $catalog = [];
    public $recentCatalog = [];

    public function mount(){
        $this->signedInvoices   = Invoice::orderBy('id', 'DESC')->where('signed', true)->get();
        $this->unsignedInvoices = Invoice::orderBy('id', 'DESC')->where('signed', false)->get();
        $this->catalog          = CompanyCatalogue::all();
        $this->recentCatalog    = CompanyCatalogue::orderBy('id', 'DESC')->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.contact.components.contact-dashboard');
    }
}
