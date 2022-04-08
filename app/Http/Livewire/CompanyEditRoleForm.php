<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use App\Models\CompanyPermissionRole;
use App\Models\CompanyRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CompanyEditRoleForm extends Component
{
    public $name;
    public $description;

    // All company permissions
    public $permissions;
    public $assignAllPermissions;
    public $selectedPermissions = [];

    // Privileges
//    public $read   = [];
//    public $write  = [];
//    public $update = [];
//    public $delete = [];


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

        // Check if the role exist for the company
        if (CompanyRole::where('company_id', Auth::user()->company_id)->where('name', Str::slug($this->name))->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Role exist']);
        }

        // Create the company role
        $company_role = CompanyRole::create([
            'company_id'    => Auth::user()->company_id,
            'display_name'  => $this->name,
            'name'          => Str::slug($this->name),
            'description'   => $this->description
        ]);

        // Check if assign all permission is selected
        if ($this->assignAllPermissions){
            foreach ($this->permissions as $permission){
                CompanyPermissionRole::create([
                    'company_id'            => Auth::user()->company_id,
                    'company_role_id'       => $company_role->id,
                    'company_permission_id' => $permission->id
                ]);
            }
        }else{
            if (count($this->selectedPermissions) == 0){
                return $this->emit('alert', ['type' => 'error', 'message' => 'Please a select at least one permission']);
            }
            foreach ($this->selectedPermissions as $permission){
                CompanyPermissionRole::create([
                    'company_id'            => Auth::user()->company_id,
                    'company_role_id'       => $company_role->id,
                    'company_permission_id' => $permission
                ]);
            }
        }

        $this->resetExcept('permissions');
        $this->emit('refreshCompanyRoles');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Role created!']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-role-form');
    }
}
