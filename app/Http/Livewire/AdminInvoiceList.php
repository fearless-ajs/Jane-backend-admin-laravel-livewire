<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class AdminInvoiceList extends LiveNotify
{
    use WithPagination;

    public $companies;
    public $companySearch;

    public $company;
    public $companyInvoices;

    protected $listeners = [
        'delete'    => 'delete'
    ];

    public function updated(){
        if ($this->companySearch){
            $this->companies = Company::where('name', 'LIKE', "%{$this->companySearch}%")->get();
        }
    }

    public function delete($invoice_id){
        $invoice = Invoice::find($invoice_id);
        if ($invoice){
            // Delete invoice catalogues
            if (count($invoice->catalogues) > 0){
                $invoice->catalogues->each->delete();
            }
            $invoice->delete();
        }
        $this->reset();
        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice deleted']);
    }

    public function remove($id){
        $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $id);
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
