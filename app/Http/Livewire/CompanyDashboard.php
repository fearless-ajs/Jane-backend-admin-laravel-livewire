<?php

namespace App\Http\Livewire;

use App\Models\CartOrderCatalogue;
use App\Models\InvoiceOrderCatalogue;
use Livewire\Component;

class CompanyDashboard extends Component
{
    // 1. Fetch the top 7 products, group_by catalogue_id then pick the ordered between a month selected month range (default last month)

    // 2. Fetch all last 7 orders,

    // 3. Fetch the top 7 buyer, fetch orders and group_by user_id between a month selected month range(default last month)

    public $company;
    public $totalSales = 0;
    public $totalRevenue = 0.00;

    public function mount($company){
        $this->company = $company;

        $cartOrderCatalogues     = CartOrderCatalogue::where('company_id', $this->company->id)->get();
        $invoiceOrderCatalogues  = InvoiceOrderCatalogue::where('company_id', $this->company->id)->get();

        $this->totalRevenue = $cartOrderCatalogues->sum('total_price') + $invoiceOrderCatalogues->sum('total_price') ;
        $this->totalSales   =   $cartOrderCatalogues->sum('quantity') + $invoiceOrderCatalogues->sum('quantity');
    }

    public function render()
    {
        return view('livewire.company.components.company-dashboard');
    }
}
