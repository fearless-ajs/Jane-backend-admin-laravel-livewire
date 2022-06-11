<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CompanyBillingCycle;
use App\Models\CompanyCatalogue;
use App\Models\CompanyCatalogueImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditCatalogueForm extends Component
{
    use WithFileUploads;

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



    public $catalogue;
    public function mount($catalogue){
        $this->fetchCategories();
        $this->catalogue = $catalogue;

        $this->name             = $catalogue->name;
        $this->brand            = $catalogue->brand;
        $this->price            = $catalogue->price;
        $this->previous_price   = $catalogue->previous_price;
        $this->quantity         = $catalogue->quantity;
        $this->category         = $catalogue->category;
        $this->vat              = $catalogue->vat;
        $this->manufacturer     = $catalogue->manufacturer;
        $this->description      = $catalogue->description;
        $this->status           = $catalogue->status;
        $this->money_back       = $catalogue->money_back_days;
        $this->active           = $catalogue->active;
        $this->cycle            = $catalogue->billing_cycle;

        if ($catalogue->billing_cycle){
            $this->billing = 'recurrent';
        }
    }

    public function fetchCategories(){
        $this->categories = Category::where('company_id', Auth::user()->company_id)->get();
        $this->cycles     = CompanyBillingCycle::where('company_id', Auth::user()->company_id)->get();
    }


    public function updated($field){
        if ($this->billing === 'once'){
            $this->validateOnly($field, [
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric|min:1|max:100',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'brand'                  => 'nullable|max:255',
                'money_back'             => 'nullable|numeric|min:0',
                'quantity'               => 'required|numeric|min:1',
                'manufacturer'           => 'nullable|string|max:255',
                'active'                 => 'nullable',
                'images'                 => 'nullable|array|max:10',
                'images.*'               => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        if ($this->billing === 'recurrent'){
            $this->validateOnly($field, [
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric|min:1|max:100',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'cycle'                  => 'required|numeric',
                'money_back'             => 'nullable|numeric|min:0',
                'active'                 => 'nullable',
                'images'                 => 'nullable|array|max:10',
                'images.*'               => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

    }

    public function updateCatalogue(){
        if ($this->billing === 'once'){
            $this->validate([
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric|min:1|max:100',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'brand'                  => 'nullable|max:255',
                'money_back'             => 'nullable|numeric|min:0',
                'quantity'               => 'required|numeric|min:1',
                'manufacturer'           => 'nullable|string|max:255',
                'active'                 => 'nullable',
                'images'                 => 'nullable|array|max:10',
                'images.*'               => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        if ($this->billing === 'recurrent'){
            $this->validate([
                'name'                   => 'required|max:255',
                'price'                  => 'required|numeric|min:1',
                'vat'                    => 'nullable|numeric|min:1|max:100',
                'previous_price'         => 'nullable|numeric|min:1',
                'category'               => 'nullable|string|max:255',
                'description'            => 'required|string|max:1000',
                'cycle'                  => 'required|numeric',
                'money_back'             => 'nullable|numeric|min:0',
                'active'                 => 'nullable',
                'images'                 => 'nullable|array|max:10',
                'images.*'               => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);
        }

        // Check if the product exist for the company
        if (CompanyCatalogue::where('company_id', Auth::user()->company_id)->where('name', $this->name)->where('id', '!=', $this->catalogue->id)->first()){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Catalogue exist already']);
        }

        if ($this->billing === 'once'){
            $this->cycle = null;
        }
        if ($this->billing === 'recurrent'){
            $this->brand        = null;
            $this->money_back   = null;
            $this->quantity     = null;
            $this->manufacturer = null;
        }

        $this->catalogue->update([
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


        // Check if images are uploaded
        if (count($this->images) > 0){
            // Upload the image
            foreach ($this->images as $image){
                $catalogueImage = $image->store('/', 'catalogues');
                CompanyCatalogueImage::create([
                    'company_catalogue_id'    =>  $this->catalogue->id,
                    'image'                   => $catalogueImage
                ]);
            }
        }


        $this->emit('refreshCatalogueDetails');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Catalogue updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-catalogue-form');
    }
}
