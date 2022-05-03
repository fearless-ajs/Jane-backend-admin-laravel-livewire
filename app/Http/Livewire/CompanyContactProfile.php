<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class CompanyContactProfile extends Component
{
    public $contact;
    protected $listeners = ['refreshContactProfile' => '$refresh'];

    public function mount($contact){
        $this->contact = Contact::find($contact->id);
    }

    public function render()
    {
        return view('livewire.company.components.company-contact-profile');
    }
}
