<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyPermission;
use App\Models\CompanyPermissionModule;
use App\Models\CompanyPermissionRole;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyPermissionsList extends Component
{
    use WithPagination;
    public $company;
    public $editPermission;

    protected $listeners = ['refreshCompanyPermissions'  =>  '$refresh'];
    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyPermission::where('company_id', $this->company->id)->where('display_name', 'LIKE', "%{$this->search}%")->get();
        }
    }

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


        // Delete permission modules
        CompanyPermissionModule::where('company_permission_id', $company_permission_id)->delete();

        CompanyPermission::find($company_permission_id)->delete();
        $this->emit('refreshCompanyPermissions');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission deleted']);
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-permissions-list', [
                'permissions' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-permissions-list', [
                'permissions' => CompanyPermission::where('company_id', $this->company->id)->paginate(12)
            ]);
        }
    }
}
