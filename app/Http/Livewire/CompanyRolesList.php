<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyPermissionRole;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyRolesList extends LiveNotify
{
    use WithPagination;
    public $company;
    protected $listeners = [
        'refreshCompanyRoles' => '$refresh',
        'delete'    =>  'delete'
    ];
    public $search;
    public $searchResult;

    public function remove($invoice_id){
        return $this->confirmDelete('warning', 'Do you want to delete?', 'Press ok to continue', $invoice_id);
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyRole::where('company_id', $this->company->id)->where('display_name', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
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
            return view('livewire.company.components.company-roles-list', [
                'roles' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-roles-list', [
                'roles' => CompanyRole::where('company_id', $this->company->id)->paginate(12)
            ]);
        }
    }
}
