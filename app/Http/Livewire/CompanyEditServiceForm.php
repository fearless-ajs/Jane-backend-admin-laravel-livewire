<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CompanyEditServiceForm extends Component
{
    public $service;

    public $name;
    public $price;
    public $previous_price;
    public $category;
    public $vat;
    public $description;
    public $usage_unit;
    public $unit_number;
    public $status;
    public $money_back;
    public $active;

    public function updated($field){
        $this->validateOnly($field, [
            'name'                   => 'required|max:255',
            'price'                  => 'required|numeric|min:1',
            'vat'                    => 'nullable|numeric|min:1|max:100',
            'category'               => 'nullable|string|max:255',
            'description'            => 'required|string|max:1000',
            'usage_unit'             => 'required|string|max:255',
            'unit_number'            => 'required|numeric|max:255',
            'money_back'             => 'nullable|numeric|min:0',
            'active'                 => 'nullable',
        ]);
    }


    public function mount($service){
        $this->service          = $service;
        $this->name             = $service->name;
        $this->price            = $service->price;
        $this->category         = $service->category;
        $this->vat              = $service->vat;
        $this->description      = $service->description;
        $this->usage_unit       = $service->usage_unit;
        $this->unit_number      = $service->unit_number;
        $this->status           = $service->status;
        $this->money_back       = $service->money_back_days;
        $this->active           = $service->active;
    }

    public function updateService(){
        $this->validate([
            'name'                   => 'required|max:255',
            'price'                  => 'required|numeric|min:1',
            'vat'                    => 'nullable|numeric|min:1|max:100',
            'category'               => 'nullable|string|max:255',
            'description'            => 'required|string|max:1000',
            'usage_unit'             => 'required|string|max:255',
            'unit_number'            => 'required|numeric|max:255',
            'money_back'             => 'nullable|numeric|min:0',
            'active'                 => 'nullable',
        ]);

        Service::where('id', $this->service->id)->update([
            'name'                  => $this->name,
            'slug'                  => Str::slug($this->name),
            'price'                 => $this->price,
            'vat'                   => $this->vat,
            'category'              => $this->category,
            'usage_unit'            => $this->usage_unit,
            'unit_number'            => $this->unit_number,
            'description'           => $this->description,
            'money_back_days'       => $this->money_back,
            'active'                => ($this->active)? true: false,
        ]);

        $this->emit('refreshServiceDetails');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service updated']);

    }

    public function render()
    {
        return view('livewire.company.components.company-edit-service-form');
    }
}
