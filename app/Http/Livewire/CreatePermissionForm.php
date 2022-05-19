<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreatePermissionForm extends LiveNotify
{
    public $name;
    public $description;

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
        CompanyPermission::create([
           'company_id'     => Auth::user()->company_id,
           'name'           => Str::slug($this->name),
           'display_name'   => $this->name,
           'description'    => $this->description,
           'type'           => 'custom'
        ]);

        $this->reset();
        $this->emit('refreshCompanyPermissions');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Permission created']);
    }

    public function render()
    {
        return view('livewire.company.components.create-permission-form');
    }
}
