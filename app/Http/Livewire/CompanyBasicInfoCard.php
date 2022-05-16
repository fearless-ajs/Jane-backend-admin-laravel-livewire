<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class CompanyBasicInfoCard extends Component
{
    public $company;

    protected $listeners = ['refreshCompanyBasicInfoCard' => 'fetchCompanyInformation'];

    public function mount($company){
        $this->company = $company;
    }

    public function fetchCompanyInformation(){
        $this->company = Company::find($this->company->id);
    }

    public function render()
    {
        return view('livewire.company.components.company-basic-info-card');
    }
}
