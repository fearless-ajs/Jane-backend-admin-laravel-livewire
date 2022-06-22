<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyInvoiceList extends Component
{
    use WithPagination;

    public function remove($invoice_id){
        $invoice = Invoice::find($invoice_id);
        if ($invoice){
            // Delete invoice catalogues
            if (count($invoice->catalogues) > 0){
                foreach ($invoice->catalogues as $catalogue){
                    $catalogue->delete();
                }
            }
            $invoice->delete();
        }
        $this->reset();
        return $this->emit('alert', ['type' => 'success', 'message' => 'Invoice deleted']);
    }

    public function render()
    {
        return view('livewire.company.components.company-invoice-list', [
            'invoices' => Invoice::orderBy('id', 'DESC')->where('company_id', Auth::user()->company_id)->paginate(200)
        ]);
    }
}
