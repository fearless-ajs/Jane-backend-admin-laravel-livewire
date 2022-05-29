<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyModule;
use App\Models\CompanyPermission;
use App\Models\CompanyPermissionModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreatePermissionForm extends LiveNotify
{
    public $name;
    public $description;

    public $assignAllModules;
    public $modules;
    public $selectedModules = [];

    public function mount(){
        $this->fetchModules();
    }

    public function fetchModules(){
        $this->modules = CompanyModule::all();
    }

    public function updated($field){
        $this->validateOnly($field, [
           'name'           => 'required|string|max:255',
           'description'    => 'required|string|max:255'
        ]);
    }

    public function create(){
        $this->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:100'
        ]);

        // Check if the permission already exist for the Company
        if (CompanyPermission::where('name', $this->name)->where('company_id', Auth::user()->company_id)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Permission exist']);
        }

        // CLose the modal
      $permission =   CompanyPermission::create([
           'company_id'     => Auth::user()->company_id,
           'name'           => Str::slug($this->name),
           'display_name'   => $this->name,
           'description'    => $this->description,
           'type'           => 'custom'
        ]);

        // Check if assign all permission is selected
        if ($this->assignAllModules){
            foreach ($this->modules as $module){
                CompanyPermissionModule::create([
                    'company_id'                  => Auth::user()->company_id,
                    'company_permission_id'       => $permission->id,
                    'company_module_id'           => $module
                ]);
            }
        }else{
            if (count($this->selectedModules) == 0){
                return $this->emit('alert', ['type' => 'error', 'message' => 'Please a select at least one module']);
            }
            foreach ($this->selectedModules as $module){
                CompanyPermissionModule::create([
                    'company_id'                  => Auth::user()->company_id,
                    'company_permission_id'       => $permission->id,
                    'company_module_id'           => $module
                ]);
            }
        }

        $this->resetExcept('modules');
        $this->emit('refreshCompanyPermissions');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission created']);
    }

    public function render()
    {
        return view('livewire.company.components.create-permission-form');
    }
}
