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

    // All Company permissions
    public $permissions;
    public $assignAllPermissions;
    public $selectedPermissions = [];

    // Privileges
//    public $read   = [];
//    public $write  = [];
//    public $update = [];
//    public $delete = [];

    public $role;


    public function mount($role)
    {
        $this->role = $role;
        $this->fetchCompanyPermissions();
        $this->fetchData();
    }

    public function fetchCompanyPermissions(){
        $this->permissions = CompanyPermission::where('company_id', Auth::user()->company_id)->get();
    }

    public function fetchData(){
        $this->name        = $this->role->display_name;
        $this->description = $this->role->description;

        $this->fetchSelectedModules();
    }


    public function fetchSelectedModules(){
        $selected = [];
        $permissions = CompanyPermissionRole::where('company_id', Auth::user()->company_id)->where('company_role_id', $this->role->id)->get();
        if (count($permissions) > 0){
            foreach ($permissions as $permission){
                array_push($selected, $permission->company_permission_id);
            }
        }
        $this->selectedPermissions = $selected;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255'
        ]);
    }

    public function updateRole(){
        $this->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:100'
        ]);

        // Check if the role exist for the Company
        if (CompanyRole::where('company_id', Auth::user()->company_id)->where('name', Str::slug($this->name))->where('id', '!=', $this->role->id)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Role exist']);
        }

        // Create the Company role
        $company_role = CompanyRole::where('id', $this->role->id)->update([
            'display_name'  => $this->name,
            'name'          => Str::slug($this->name),
            'description'   => $this->description
        ]);

        // Check if assign all permission is selected
        if ($this->assignAllPermissions){
            foreach ($this->permissions as $permission){
                if (!CompanyPermissionRole::where('company_id', Auth::user()->company_id)->where('company_permission_id', $permission->id)->first()){
                    CompanyPermissionRole::create([
                        'company_id'            => Auth::user()->company_id,
                        'company_role_id'       => $this->role->id,
                        'company_permission_id' => $permission->id
                    ]);
                }
            }
        }else{
            if (count($this->selectedPermissions) == 0){
                return $this->emit('alert', ['type' => 'error', 'message' => 'Please a select at least one permission']);
            }
            foreach ($this->selectedPermissions as $permission){
                if (!CompanyPermissionRole::where('company_id', Auth::user()->company_id)->where('company_permission_id', $permission)->first()){
                    CompanyPermissionRole::create([
                        'company_id'            => Auth::user()->company_id,
                        'company_role_id'       => $this->role->id,
                        'company_permission_id' => $permission
                    ]);
                }
            }


            // Delete the unchecked records
            $existingRolePermissions = CompanyPermissionRole::where('company_role_id', $this->role->id)->where('company_id', Auth::user()->company_id)->get();
            $permissions = [];
            // find each id from the selectModule
            if (count($existingRolePermissions) > 0){
                foreach ($existingRolePermissions as $permission){
                    array_push($permissions, $permission->company_permission_id);
                }
            }

            $diff_permissions = array_diff($permissions, $this->selectedPermissions);
            if (count($diff_permissions) > 0){
                foreach ($diff_permissions as $diff_permission){
                    CompanyPermissionRole::where('company_role_id', $this->role->id)->where('company_id', Auth::user()->company_id)->where('company_permission_id', $diff_permission)->first()->delete();
                }
            }

        }

        return $this->emit('alert', ['type' => 'success', 'message' => 'Role updated!']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-role-form');
    }
}
