<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyServiceDetails extends Component
{

    public $service;
    protected $listeners = ['refreshServiceDetails' => '$refresh'];

    public function mount($service){
        $this->service = $service;
    }
    public function render()
    {
        return view('livewire.company.components.company-service-details');
    }
}
