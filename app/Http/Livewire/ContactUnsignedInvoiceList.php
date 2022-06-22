<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactUnsignedInvoiceList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.contact.components.contact-unsigned-invoice-list', [
            'invoices'  => Invoice::where('contact_id', Auth::user()->contact->id)->where('signed', false)->paginate(12)
        ]);
    }
}
