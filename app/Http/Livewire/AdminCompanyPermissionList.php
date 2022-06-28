<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use App\Models\CompanyPermissionModule;
use App\Models\CompanyPermissionRole;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyPermissionList extends Component
{
    use WithPagination;
    public $company;
    public $editPermission;

    protected $listeners = [
        'refreshCompanyPermissions'  =>  '$refresh',
        'delete'                     =>  'delete'
    ];
    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyPermission::where('company_id', $this->company->id)->where('display_name', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
    }

    public function setEditPermission($permission_id){
        $this->editPermission = $permission_id;
        $this->emit('refreshEditCompanyPermission');
    }


    public function remove($company_permission_id){
        $this->confirmDelete('Warning', 'Do you really want to delete?', 'Press ok to continue', $company_permission_id);
    }


    public function delete($company_permission_id){
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
            return view('livewire.admin.components.admin-company-permission-list', [
                'permissions' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-permission-list', [
                'permissions' => CompanyPermission::where('company_id', $this->company->id)->paginate(12)
            ]);
        }
    }
}
