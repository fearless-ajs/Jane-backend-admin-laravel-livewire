<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyContactList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshContactList' => '$refresh'];

    public function remove($contact_id){
        $contact = Contact::find($contact_id);

        // Delete the contact transactions
        $contact->transactions->each->delete();

        // Delete contact itself
        $contact->delete();

        $this->emit('refreshContactList');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Contact deleted']);
    }

    public function render()
    {
        return view('livewire.company.components.company-contact-list', [
            'contacts'  => Contact::where('company_id', Auth::user()->company_id)->paginate(100)
        ]);
    }
}
