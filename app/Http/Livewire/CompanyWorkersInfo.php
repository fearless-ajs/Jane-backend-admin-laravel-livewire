<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyWorkersInfo extends Component
{
    public $worker;
    public $rolesAndPermissionCard = true;
    public $securityCard;

    protected $listeners = [
      'showRolesAndPermissionCard',
      'showSecurityCard'
    ];

    public function showRolesAndPermissionCard(){
        $this->securityCard           = false;
        $this->rolesAndPermissionCard = true;
    }

    public function showSecurityCard(){
        $this->rolesAndPermissionCard = false;
        $this->securityCard           = true;
    }

    public function mount($worker){
        $this->worker = $worker;
    }

    public function render()
    {
        return view('livewire.company.components.company-workers-info');
    }
}
