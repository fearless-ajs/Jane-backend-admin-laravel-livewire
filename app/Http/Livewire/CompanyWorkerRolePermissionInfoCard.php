<?php

namespace App\Http\Livewire;

use App\Models\CompanyRole;
use App\Models\CompanyTeam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyWorkerRolePermissionInfoCard extends Component
{

    public $worker;

    // Selected roles
    public $role=[];
    public $team=[];

    // database roles
    public $roles;
    public $teams;

    public function mount($worker)
    {
        $this->worker = $worker;
        $this->fetchData();
    }

    public function fetchData(){
        $this->roles  = CompanyRole::where('company_id', Auth::user()->company_id)->get();
        $this->teams  = CompanyTeam::where('company_id', Auth::user()->company_id)->get();
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-role-permission-info-card');
    }
}
