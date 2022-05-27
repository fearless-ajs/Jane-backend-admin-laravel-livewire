<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyInvoiceList extends Component
{
    use WithPagination;

    public $company;
    public $settings;

    public function mount($company){
        $this->settings = Setting::first();
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-invoice-list', [
            'invoices'  =>  Invoice::where('company_id', $this->company->id)->paginate(12)
        ]);
    }
}
