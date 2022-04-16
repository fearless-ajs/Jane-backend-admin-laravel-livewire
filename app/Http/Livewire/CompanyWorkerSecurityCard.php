<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyWorkerSecurityCard extends Component
{

    public $worker;

    public function mount($worker){
        $this->worker = $worker;
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-security-card');
    }
}
