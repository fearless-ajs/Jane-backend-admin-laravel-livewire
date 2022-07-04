<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use App\Models\CompanyPermissionUser;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class CompanyWorkerPermissionInfoCard extends Component
{

    public $worker;

    // Selected roles
    public $role=[];
    public $permission=[];

    // database roles
    public $roles;
    public $permissions;
    public $currentUrl;

    protected $listeners = ['refreshWorkerPermission' => '$refresh'];

    public function mount($worker)
    {
        $this->worker = $worker;
        $this->fetchData();
        $this->currentUrl = Route::currentRouteName();
    }


    public function updatePermission(){
        $this->validate([
            'permission'                  => 'array',
        ]);


        // Check if new teams is supplied
        if(count($this->permission) > 0){
            // Check if the team exist first then ignore
            foreach ($this->permission as $permission){
                if (!CompanyPermissionUser::where('user_id', $this->worker->user_id)
                    ->where('company_permission_id', $permission)
                    ->where('company_id', $this->worker->company_id)->first())
                {
                    CompanyPermissionUser::create([
                        'company_id'              => $this->worker->company_id,
                        'user_id'                 => $this->worker->user_id,
                        'company_permission_id'   => $permission,
                    ]);
                }else{
                    $this->emit('alert', ['type' => 'info', 'message' => 'User already this permission']);
                }
            }
        }

        $this->emit('refreshWorkerPermission');
        $this->emit('refreshWorkerBasicInfoCard');
        $this->resetExcept(['permissions', 'worker']);
        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission attached to user']);
    }

    public function fetchData(){
        $this->roles        = CompanyRole::where('company_id', $this->worker->company_id)->get();
        $this->permissions  = CompanyPermission::where('company_id', $this->worker->company_id)->get();
    }

    public function detachPermission($permission_id){
        CompanyPermissionUser::where('id', $permission_id)->delete();
        $this->emit('refreshWorkerPermission');
        $this->emit('refreshWorkerBasicInfoCard');
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission detached from user']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-permission-info-card');
    }
}
