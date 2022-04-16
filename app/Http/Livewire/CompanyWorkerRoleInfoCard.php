<?php

namespace App\Http\Livewire;

use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyWorkerRoleInfoCard extends Component
{

    public $worker;

    // Selected roles
    public $role=[];
    public $team=[];

    // database roles
    public $roles;
    public $teams;

    protected $listeners = ['refreshWorkerRole' => '$refresh'];

    public function mount($worker)
    {
        $this->worker = $worker;
        $this->fetchData();
    }

    public function updated($field){
        $this->validateOnly($field, [
            'role'                  => 'array',
        ]);
    }

    public function updateRole(){
        $this->validate([
            'role'                  => 'array',
        ]);

        // Check if new roles is supplied
        if(count($this->role) > 0){
            // Check if the role exist first then ignore
            foreach ($this->role as $role){
                if (!CompanyRoleUser::where('user_id', $this->worker->user_id)
                    ->where('company_role_id', $role)
                    ->where('company_id', Auth::user()->company_id)->first())
                {
                    CompanyRoleUser::create([
                        'company_id'        => Auth::user()->company_id,
                        'user_id'           => $this->worker->user->id,
                        'company_role_id'   => $role,
                    ]);
                }else{
                    return $this->emit('alert', ['type' => 'info', 'message' => 'Worker already has the selected role']);
                }
            }

        }

        $this->emit('refreshWorkerRole');
        $this->emit('refreshWorkerBasicInfoCard');
        $this->resetExcept(['roles', 'worker']);
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker roles updated']);
    }


    public function fetchData(){
        $this->roles  = CompanyRole::where('company_id', Auth::user()->company_id)->get();
        $this->teams  = CompanyTeam::where('company_id', Auth::user()->company_id)->get();
    }

    public function detachRole($role_id){
        CompanyRoleUser::where('id', $role_id)->delete();
        $this->emit('refreshWorkerRole');
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Role detached from worker']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-role-info-card');
    }
}
