<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class AdminInvoiceList extends Component
{
    use WithPagination;

    public $companies;
    public $companySearch;

    public $company;
    public $companyInvoices;

    public function updated(){
        if ($this->companySearch){
            $this->companies = Company::where('name', 'LIKE', "%{$this->companySearch}%")->get();
        }
    }


    public function clearFilter(){
        $this->company       = null;
        $this->companySearch = null;
        $this->companies     = null;
    }

    public function render()
    {
        if ($this->company && !empty($this->companySearch)){
            return view('livewire.admin.components.admin-invoice-list', [
                'invoices'  =>  Invoice::where('company_id', $this->company)->orderBy('id', 'DESC')->paginate(12)
            ]);
        }
        return view('livewire.admin.components.admin-invoice-list', [
            'invoices'  =>  Invoice::orderBy('id', 'DESC')->paginate(12)
        ]);
    }
}
