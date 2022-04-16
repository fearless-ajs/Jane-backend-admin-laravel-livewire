<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyWorkerBasicInfoCard extends Component
{
    public $worker;

    protected $listeners = ['refreshWorkerBasicInfoCard' => '$refresh'];

    public function mount($worker){
        $this->worker = $worker;
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-basic-info-card');
    }
}
