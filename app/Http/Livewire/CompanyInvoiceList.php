<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyInvoiceList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.company.components.company-invoice-list', [
            'invoices' => Invoice::where('company_id', Auth::user()->company_id)->paginate(200)
        ]);
    }
}
