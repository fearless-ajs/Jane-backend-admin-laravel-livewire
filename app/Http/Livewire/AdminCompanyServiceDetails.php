<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyServiceDetails extends Component
{
    public $service;

    public function mount($service){
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-service-details');
    }
}
