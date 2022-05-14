<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyContactList extends Component
{
    public $contacts;
    public function mount($company){
        $this->contacts = $company->contacts;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-contact-list');
    }
}
