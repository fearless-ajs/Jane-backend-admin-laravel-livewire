<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use App\Models\CompanyPermissionRole;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyRolesList extends LiveNotify
{
    use WithPagination;
    public $company;
    protected $listeners = [
        'refreshCompanyRoles' => '$refresh',
        'delete'              => 'delete'
    ];
    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyRole::where('company_id', $this->company->id)->where('display_name', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
    }

    public function remove($role_id){
        $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $role_id);
    }

    public function delete($role_id){
        // Remove role permissions
        CompanyPermissionRole::where('company_id', Auth::user()->company_id)->where('company_role_id', $role_id)->delete();
        // Remove role users
        CompanyRoleUser::where('company_id', Auth::user()->company_id)->where('company_role_id', $role_id)->delete();
        // Finally remove the role
        CompanyRole::find($role_id)->delete();
        // Refresh the list
        $this->emit('refreshCompanyRoles');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Role deleted']);
    }


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-roles-list', [
                'roles' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-roles-list', [
                'roles' => CompanyRole::where('company_id', $this->company->id)->paginate(12)
            ]);
        }
    }
}
