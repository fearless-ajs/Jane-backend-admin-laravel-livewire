<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Livewire\Component;

class AdminCompanyServiceList extends Component
{

    public $company;

    public $search;
    public $searchResult;

    public $order;

    public $categories;
    public $category;
    public $settings;
    public function updated(){
        if ($this->search){
            if ($this->order){
                if ($this->category){
                    $this->searchResult = Service::where('company_id', $this->company->id)
                        ->orderBy('price', $this->order)
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->where('category', $this->category)->get();
                }else{
                    $this->searchResult = Service::where('company_id', $this->company->id)->orderBy('price', $this->order)->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }else{
                if ($this->category){

                    $this->searchResult = Service::where('company_id', $this->company->id)->where('name', 'LIKE', "%{$this->search}%")->where('category', $this->category)->get();
                }else{
                    $this->searchResult = Service::where('company_id', $this->company->id)->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }
        }

    }

    public function clearFilter(){
        $this->category = null;
        $this->search = null;
        $this->searchResult = null;
        $this->order    = null;
    }

    public function setOrder($order='ASC'){
        $this->order = $order;
    }

    public function mount($company){
        $this->settings =  Setting::first();
        $this->company = $company;
        $this->categories   =   Category::where('company_id', $this->company->id)->get();
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-service-list', [
                'services' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            if ($this->category){
                if ($this->order){
                    return view('livewire.admin.components.admin-company-service-list', [
                        'services' => Service::where('company_id', $this->company->id)->where('category', $this->category)->orderBy('price', $this->order)->paginate(12)
                    ]);
                }else{
                    return view('livewire.admin.components.admin-company-service-list', [
                        'services' => Service::where('company_id', $this->company->id)->where('category', $this->category)->paginate(12)
                    ]);
                }
            }else{
                return view('livewire.admin.components.admin-company-service-list', [
                    'services' => Service::where('company_id', $this->company->id)->paginate(12)
                ]);
            }
        }
    }
}
