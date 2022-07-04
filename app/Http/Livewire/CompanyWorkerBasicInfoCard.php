<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermissionUser;
use App\Models\CompanyRoleUser;
use App\Models\Worker;
use Livewire\Component;

class CompanyWorkerBasicInfoCard extends Component
{
    public $worker;
    public $permissions = [];
    public $roles = [];

    protected $listeners = ['refreshWorkerBasicInfoCard' => 'refreshComponent'];

    public function mount($worker){
        $this->worker = $worker;
        $this->fetchCompanyRolesAndPermissions();
    }


    public function refreshComponent(){
        $this->resetExcept('worker');
        $this->fetchCompanyRolesAndPermissions();
    }

    public function fetchCompanyRolesAndPermissions(){
        $permissions = CompanyPermissionUser::where('user_id', $this->worker->user->id)->where('company_id', $this->worker->company->id)->get();
        if ($permissions){
            $this->permissions = $permissions;
        }

        $roles = CompanyRoleUser::where('user_id', $this->worker->user->id)->where('company_id', $this->worker->company->id)->get();
        if ($roles){
            $this->roles = $roles;
        }

    }

    public function suspendWorker(){
        Worker::where('id', $this->worker->id)->update([
            'available'     => false
        ]);

        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker suspended']);
    }

    public function activateWorker(){
        Worker::where('id', $this->worker->id)->update([
            'available'     => true
        ]);

        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker activate']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-basic-info-card');
    }
}
