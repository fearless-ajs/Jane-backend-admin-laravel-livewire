<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CompanyBillingCycle;
use App\Models\CompanyCatalogue;
use App\Models\CompanyCatalogueImage;
use App\Models\CompanyTax;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyCreateCatalogueForm extends Component
{
    use WithFileUploads, FileManager;

    public $name;
    public $brand;
    public $price;
    public $previous_price;
    public $quantity;
    public $category;
    public $vat;
    public $currency;
    public $manufacturer;
    public $description;
    public $status;
    public $money_back;
    public $billing = 'once';
    public $cycle;
    public $warranty;
    public $active;
    public $images = [];

    public $categories;
    public $cycles;
    public $taxes;

    public $company;

    public function mount($company){
        $this->company = $company;
        $this->fetchCategories();
    }

    public function fetchCategories(){
        $this->categories = Category::where('company_id', $this->company->id)->get();
        $this->cycles     = CompanyBillingCycle::where('company_id', $this->company->id)->get();
        $this->taxes      = CompanyTax::where('company_id', $this->company->id)->get();

    }



    public function updated($field){
        if ($this->billing === 'once'){
            $this->validateOnly($field, [
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'brand'                  => 'nullable|max:255',
                'money_back'             => 'nullable|numeric|min:0',
                'quantity'               => 'required|numeric|min:1',
                'manufacturer'           => 'nullable|string|max:255',
                'active'                 => 'nullable',
                'images'                 => 'required|array|min:1|max:10',
                'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        if ($this->billing === 'recurrent'){
            $this->validateOnly($field, [
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'cycle'                  => 'required|numeric',
                'money_back'             => 'nullable|numeric|min:0',
                'active'                 => 'nullable',
                'images'                 => 'required|array|min:1|max:10',
                'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

    }

    public function addCatalogue(){
        if ($this->billing === 'once'){
            $this->validate([
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'brand'                  => 'nullable|max:255',
                'money_back'             => 'nullable|numeric|min:0',
                'quantity'               => 'required|numeric|min:1',
                'manufacturer'           => 'nullable|string|max:255',
                'active'                 => 'nullable',
                'images'                 => 'required|array|min:1|max:10',
                'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        if ($this->billing === 'recurrent'){
            $this->validate([
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'cycle'                  => 'required|numeric',
                'money_back'             => 'nullable|numeric|min:0',
                'active'                 => 'nullable',
                'images'                 => 'required|array|min:1|max:10',
                'images.*'               => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        // Check if the product exist for the company
        if (CompanyCatalogue::where('company_id', $this->company->id)->where('name', $this->name)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Catalogue exist already']);
        }

        $catalogue = CompanyCatalogue::create([
            'company_id'            => $this->company->id,
            'user_id'               => Auth::user()->id,
            'name'                  => $this->name,
            'brand'                 => $this->brand,
            'slug'                  => Str::slug($this->name),
            'price'                 => $this->price,
            'previous_price'        => $this->previous_price,
            'vat'                   => $this->vat,
            'category'              => $this->category,
            'quantity'              => $this->quantity,
            'manufacturer'          => $this->manufacturer,
            'description'           => $this->description,
            'money_back_days'       => $this->money_back,
            'billing_cycle'         => $this->cycle,
            'type'                  => ($this->billing === 'once')?'product':'service',
            'active'                => ($this->active)? true: false,
        ]);


        // Upload the image
        foreach ($this->images as $image){
            $catalogueImage = $this->saveImage($image, 'catalogues');
            CompanyCatalogueImage::create([
                'company_catalogue_id'    =>  $catalogue->id,
                'image'                   => $catalogueImage
            ]);
        }


        $this->emit('refreshCompanyCatalogueList');
        $this->emit('close-current-modal');
        $this->resetExcept(['categories', 'cycles', 'taxes']);
        return $this->emit('alert', ['type' => 'success', 'message' => 'Catalogue added to store']);
    }

    public function removeImg($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-catalogue-form');
    }
}
