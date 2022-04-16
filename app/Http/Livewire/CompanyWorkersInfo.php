<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyWorkersInfo extends Component
{
    public $worker;
    public $rolesCard = true;
    public $teamsCard;
    public $securityCard;

    public function showRolesCard(){
        $this->securityCard  = false;
        $this->teamsCard     = false;
        $this->rolesCard     = true;
    }

    public function showTeamsCard(){
        $this->securityCard  = false;
        $this->rolesCard     = false;
        $this->teamsCard     = true;
    }

    public function showSecurityCard(){
        $this->rolesCard        = false;
        $this->teamsCard        = false;
        $this->securityCard     = true;
    }

    public function mount($worker){
        $this->worker = $worker;
    }

    public function render()
    {
        return view('livewire.company.components.company-workers-info');
    }
}
