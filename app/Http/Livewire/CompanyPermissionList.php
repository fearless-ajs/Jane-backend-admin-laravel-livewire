<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyPermission;
use App\Models\CompanyPermissionRole;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyPermissionList extends Component
{
    use WithPagination;
    public $company;
    public $editPermission;

    protected $listeners = ['refreshCompanyPermissions'  =>  '$refresh'];

    public function mount(){
        $this->company = Company::where('user_id', Auth::user()->id)->first();
    }

    public function setEditPermission($permission_id){
        $this->editPermission = $permission_id;
        $this->emit('refreshEditCompanyPermission');
    }

    public function remove($company_permission_id){
       CompanyPermissionRole::where('company_permission_id', $company_permission_id)->where('company_id', $this->company->id)->delete();
       CompanyPermissionRole::where('company_permission_id', $company_permission_id)->where('company_id', $this->company->id)->delete();

       CompanyPermission::find($company_permission_id)->delete();
       $this->emit('refreshCompanyPermissions');
       return $this->emit('alert', ['type' => 'success', 'message' => 'Permission deleted']);
    }

    public function render()
    {
        return view('livewire.Company.components.Company-permission-list', [
            'permissions' => CompanyPermission::where('company_id', $this->company->id)->paginate(100)
        ]);
    }
}
