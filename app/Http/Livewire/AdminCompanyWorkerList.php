<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyWorkerList extends Component
{
    public $workers;

    public function mount($company){
        $this->workers = $company->users;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-worker-list');
    }
}
