<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermission;
use Livewire\Component;

class EditCompanyPermissionForm extends Component
{
    public $companyPermission;
    public function mount($company_permission_id){
        $this->companyPermission = CompanyPermission::find($company_permission_id);
    }

    public function render()
    {
        return view('livewire.company.components.edit-company-permission-form');
    }
}
