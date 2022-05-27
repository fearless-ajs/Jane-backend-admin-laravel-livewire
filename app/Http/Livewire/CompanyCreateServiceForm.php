<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyCreateServiceForm extends Component
{
    use WithFileUploads;

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
    public $images = [];

    public $categories;

    public function mount(){
        $this->fetchCategories();
    }

    public function fetchCategories(){
        $this->categories = Category::where('company_id', Auth::user()->company_id)->get();
    }


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
            'images'                 => 'required|array|min:1|max:5',
            'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);
    }

    public function addService()
    {
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
            'images'                 => 'required|array|min:1|max:5',
            'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        // Check if the service exist for the company
        if (Service::where('company_id', Auth::user()->company_id)->where('name', $this->name)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Product exist already']);
        }


        // Save the product information
       $service = Service::create([
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

        // Upload the image
        foreach ($this->images as $image){
            $serviceImage = $image->store('/', 'images');
            ServiceImage::create([
                'service_id'    =>  $service->id,
                'image'         => $serviceImage
            ]);
        }

        $this->emit('refreshServiceList');
        $this->emit('close-current-modal');
        $this->resetExcept('categories');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service added']);
    }

    public function removeImg($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-service-form');
    }
}
