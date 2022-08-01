<?php

namespace App\Http\Livewire;

use App\Models\CartOrderCatalogue;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\InvoiceOrderCatalogue;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $companies;
    public $companiesCount;
    public $contacts;
    public $catalog;
    public $invoices;

    public $totalSales = 0;
    public $totalRevenue = 0.00;


    public function mount(){
        $this->companiesCount   = Company::all();
        $this->companies        = Company::orderBy('id', 'DESC')->limit(5)->get();
        $this->contacts         = Contact::all();
        $this->catalog          = CompanyCatalogue::all();
        $this->invoices         = Invoice::all();




        $cartOrderCatalogues     = CartOrderCatalogue::all();
        $invoiceOrderCatalogues  = InvoiceOrderCatalogue::all();

        $this->totalRevenue =    $cartOrderCatalogues->sum('total_price') + $invoiceOrderCatalogues->sum('total_price') ;
        $this->totalSales   =    $cartOrderCatalogues->sum('quantity') + $invoiceOrderCatalogues->sum('quantity');
    }

    public function render()
    {
        return view('livewire.admin.components.admin-dashboard');
    }
}
