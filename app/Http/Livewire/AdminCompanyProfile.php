<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminCompanyProfile extends Component
{
    public $company;
    protected $listeners = [
      'refreshAdminCompanyProfile'  => '$refresh'
    ];

    public function mount($company){
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-profile');
    }
}
