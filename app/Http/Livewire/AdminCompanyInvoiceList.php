<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyInvoiceList extends LiveNotify
{
    use WithPagination;

    public $company;
    public $settings;

    protected $listeners = [
      'delete'  => 'delete'
    ];

    public function mount($company){
        $this->settings = Setting::first();
        $this->company = $company;
    }

    public function remove($id){
        return $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $id);
    }

    public function delete($id){
        $invoice = Invoice::find($id);
        if ($invoice){
            // Delete invoice catalogues
            if (count($invoice->catalogues) > 0){
                foreach ($invoice->catalogues as $catalogue){
                    $catalogue->delete();
                }
            }
            $invoice->delete();
        }
        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice deleted']);
    }


    public function render()
    {
        return view('livewire.admin.components.admin-company-invoice-list', [
            'invoices'  =>  Invoice::where('company_id', $this->company->id)->paginate(12)
        ]);
    }
}
