<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactSignedInvoiceList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.contact.components.contact-signed-invoice-list', [
            'invoices'  => Invoice::where('contact_id', Auth::user()->contact->id)->where('signed', true)->paginate(12)
        ]);
    }
}
