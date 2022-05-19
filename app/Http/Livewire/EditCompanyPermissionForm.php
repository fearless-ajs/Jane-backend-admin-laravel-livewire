<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use Livewire\Component;

class EditCompanyPermissionForm extends Component
{
    public $permission_id;
    public $companyPermission;
    public $name;
    public $description;

    protected $listeners = ['refreshEditCompanyPermission' => 'fetchData'];

    public function fetchData() {
        $this->companyPermission = CompanyPermission::find($this->permission_id);
        $this->name = $this->companyPermission->display_name;
        $this->description = $this->companyPermission->description;
    }

    public function mount($company_permission_id){
        $this->permission_id = $company_permission_id;
        $this->fetchData();
    }

    public function render()
    {
        return view('livewire.company.components.edit-company-permission-form');
    }
}
