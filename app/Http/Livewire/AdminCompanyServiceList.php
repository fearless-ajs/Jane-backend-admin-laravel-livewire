<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyServiceList extends Component
{
    public $services;
    public function mount($company){
        $this->services = $company->services;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-service-list');
    }
}
