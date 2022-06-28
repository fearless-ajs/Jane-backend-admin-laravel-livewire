<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyModule;
use App\Models\CompanyPermission;
use App\Models\CompanyPermissionModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class EditCompanyPermissionForm extends Component
{
    public $permission_id;
    public $companyPermission;
    public $name;
    public $description;

    protected $listeners = ['refreshEditCompanyPermission' => 'fetchData'];

    public $assignAllModules;
    public $modules;
    public $selectedModules = [];

    public $company;

    public function updated($field){
        $this->validateOnly($field, [
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255'
        ]);
    }

    public function fetchModules(){
        $this->modules = CompanyModule::all();
    }

    public function fetchData() {
        $this->companyPermission = CompanyPermission::find($this->permission_id);
        $this->name = $this->companyPermission->display_name;
        $this->description = $this->companyPermission->description;
    }

    public function mount($company_permission_id){
        $this->permission_id = null;
        $this->permission_id = $company_permission_id;
        $this->fetchModules();
        $this->fetchData();
        $this->fetchSelectedModules();
        $this->company =  Company::find($this->companyPermission->company_id);
    }

    public function fetchSelectedModules(){
        $selected = [];
        $modules = CompanyPermissionModule::where('company_permission_id', $this->permission_id)->get();
        if (count($modules) > 0){
            foreach ($modules as $module){
                array_push($selected, $module->company_module_id);
            }
        }
        $this->selectedModules = $selected;
    }

    public function updateData(){
        $this->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:100'
        ]);

        // Check if the permission already exist for the Company
        if (CompanyPermission::where('name', $this->name)->where('company_id', $this->company->id)->where('id', '!=', $this->permission_id)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Permission exist']);
        }

        $permission =  CompanyPermission::where('id', $this->permission_id)->update([
            'name'           => Str::slug($this->name),
            'display_name'   => $this->name,
            'description'    => $this->description,
        ]);

        // Check if assign all permission is selected
        if ($this->assignAllModules){
            foreach ($this->modules as $module){
                // Check if exist already
                if (!CompanyPermissionModule::where('company_permission_id', $this->permission_id)->where('company_module_id', $module)->where('company_id', $this->company->id)->first()){
                    CompanyPermissionModule::create([
                        'company_id'                  => $this->company->id,
                        'company_permission_id'       => $this->permission_id,
                        'company_module_id'           => $module->id
                    ]);
                }
            }
        }else{
            if (count($this->selectedModules) == 0){
                return $this->emit('alert', ['type' => 'error', 'message' => 'Please a select at least one module']);
            }
            foreach ($this->selectedModules as $module){
                if (!CompanyPermissionModule::where('company_permission_id', $this->permission_id)->where('company_module_id', $module)->where('company_id', $this->company->id)->first()){
                    CompanyPermissionModule::create([
                        'company_id'                  => $this->company->id,
                        'company_permission_id'       => $this->permission_id,
                        'company_module_id'           => $module
                    ]);
                }
            }

            // Delete the unchecked records
            $existingPermissionModules = CompanyPermissionModule::where('company_permission_id', $this->permission_id)->where('company_id', $this->company->id)->get();
            $modules = [];
            // find each id from the selectModule
            if (count($existingPermissionModules) > 0){
                foreach ($existingPermissionModules as $module){
                    array_push($modules, $module->company_module_id);
                }
            }

            $diff_modules = array_diff($modules, $this->selectedModules);
            if (count($diff_modules) > 0){
                foreach ($diff_modules as $diff_module){
                    CompanyPermissionModule::where('company_permission_id', $this->permission_id)->where('company_id', $this->company->id)->where('company_module_id', $diff_module)->first()->delete();
                }
            }

        }

        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission updated']);
    }

    public function render()
    {
        return view('livewire.company.components.edit-company-permission-form');
    }
}
