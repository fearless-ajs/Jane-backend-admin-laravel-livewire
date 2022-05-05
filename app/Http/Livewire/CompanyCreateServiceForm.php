<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CompanyCreateServiceForm extends Component
{
    public $name;
    public $price;
    public $previous_price;
    public $quantity;
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
            'price'                  => 'nullable|numeric|min:1',
            'vat'                    => 'nullable|numeric|min:1|max:100',
            'category'               => 'nullable|string|max:255',
            'description'            => 'required|string|max:1000',
            'usage_unit'             => 'nullable|string|max:255',
            'unit_number'            => 'nullable|numeric|max:255',
            'money_back'             => 'nullable|numeric|min:0',
            'active'                 => 'nullable',
        ]);
    }

    public function addService()
    {
        $this->validate([
            'name'                   => 'required|max:255',
            'price'                  => 'nullable|numeric|min:1',
            'vat'                    => 'nullable|numeric|min:1|max:100',
            'category'               => 'nullable|string|max:255',
            'description'            => 'required|string|max:1000',
            'usage_unit'             => 'nullable|string|max:255',
            'unit_number'            => 'nullable|numeric|max:255',
            'money_back'             => 'nullable|numeric|min:0',
            'active'                 => 'nullable',
        ]);

        // Save the product information
        Service::create([
            'company_id'            => Auth::user()->company_id,
            'user_id'               => Auth::user()->id,
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

        $this->emit('refreshServiceList');
        $this->emit('close-current-modal');
        $this->reset();
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service added']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-service-form');
    }
}
