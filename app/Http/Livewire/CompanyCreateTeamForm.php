<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use App\Models\CompanyPermissionRole;
use App\Models\CompanyPermissionTeam;
use App\Models\CompanyRole;
use App\Models\CompanyTeam;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CompanyCreateTeamForm extends Component
{
    public $name;
    public $description;

    // All Company permissions
    public $permissions;
    public $assignAllPermissions;
    public $selectedPermissions = [];

    public function mount()
    {
        $this->fetchCompanyPermissions();
    }

    public function fetchCompanyPermissions(){
        $this->permissions = CompanyPermission::where('company_id', Auth::user()->company_id)->get();
    }

    public function updated($field){
        $this->validateOnly($field, [
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255'
        ]);
    }

    public function create(){
        $this->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:100'
        ]);

        // Check if the role exist for the Company
        if (CompanyRole::where('company_id', Auth::user()->company_id)->where('name', Str::slug($this->name))->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Role exist']);
        }

        // Create the Company role
        $company_team = CompanyTeam::create([
            'company_id'    => Auth::user()->company_id,
            'display_name'  => $this->name,
            'name'          => Str::slug($this->name),
            'description'   => $this->description
        ]);

        // Check if assign all permission is selected
        if ($this->assignAllPermissions){
            foreach ($this->permissions as $permission){
                CompanyPermissionTeam::create([
                    'company_id'            => Auth::user()->company_id,
                    'company_team_id'       => $company_team->id,
                    'company_permission_id' => $permission->id
                ]);
            }
        }else{
            if (count($this->selectedPermissions) == 0){
                return $this->emit('alert', ['type' => 'error', 'message' => 'Please a select at least one permission']);
            }
            foreach ($this->selectedPermissions as $permission){
                CompanyPermissionTeam::create([
                    'company_id'            => Auth::user()->company_id,
                    'company_team_id'       => $company_team->id,
                    'company_permission_id' => $permission
                ]);
            }
        }

        $this->resetExcept('permissions');
        $this->emit('refreshCompanyTeams');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Team created!']);
    }


    public function render()
    {
        return view('livewire.Company.components.Company-create-team-form');
    }
}
