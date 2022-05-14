<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class AdminCompanyContactProfile extends Component
{
    public $contact;
    protected $listeners = ['refreshContactProfile' => '$refresh'];

    public function mount($contact){
        $this->contact = Contact::find($contact->id);
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-contact-profile');
    }
}
