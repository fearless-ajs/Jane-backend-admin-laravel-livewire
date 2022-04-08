<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermissionRole;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyRoleList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshCompanyRoles' => '$refresh'];

    public function remove($role_id){
        // Remove role permissions
        CompanyPermissionRole::where('company_id', Auth::user()->company_id)->where('company_role_id', $role_id)->delete();
        // Remove role users
        CompanyRoleUser::where('company_id', Auth::user()->company_id)->where('company_role_id', $role_id)->delete();
        // Finally remove the role
        CompanyRole::find($role_id)->delete();
        // Refresh the list
        $this->emit('refreshCompanyRoles');
    }

    public function render()
    {
        return view('livewire.company.components.company-role-list', [
            'roles' => CompanyRole::where('company_id', Auth::user()->company_id)->paginate(100)
        ]);
    }
}
