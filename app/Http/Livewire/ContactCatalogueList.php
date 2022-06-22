<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Setting;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactCatalogueList extends Component
{
    use WithPagination;
    use FileManager;

    protected $listeners = ['refreshCompanyCatalogueList' => '$refresh'];
    public $settings;
    public $company;

    public $search;
    public $searchResult;

    public $order;

    public $categories;
    public $category;

    public function mount(){
        $this->settings = Setting::first();
        $this->company = Company::find(Auth::user()->company_id);
        $this->categories   =   Category::all();
    }


    public function updated(){
        if ($this->search){
            if ($this->order){
                if ($this->category){
                    $this->searchResult = CompanyCatalogue::orderBy('price', $this->order)
                        ->where('name', 'LIKE', "%{$this->search}%")
                        ->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::orderBy('price', $this->order)->where('name', 'LIKE', "%{$this->search}%")->get();
                }
            }else{
                if ($this->category){

                    $this->searchResult = CompanyCatalogue::where('name', 'LIKE', "%{$this->search}%")->where('category', $this->category)->get();
                }else{
                    $this->searchResult = CompanyCatalogue::where('name', 'LIKE', "%{$this->search}%")->get();
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


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.contact.components.contact-catalogue-list', [
                'catalogues' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            if ($this->category){
                if ($this->order){
                    return view('livewire.contact.components.contact-catalogue-list', [
                        'catalogues' => CompanyCatalogue::where('category', $this->category)->orderBy('price', $this->order)->paginate(12)
                    ]);
                }else{
                    return view('livewire.contact.components.contact-catalogue-list', [
                        'catalogues' => CompanyCatalogue::where('category', $this->category)->paginate(12)
                    ]);
                }
            }else{
                return view('livewire.contact.components.contact-catalogue-list', [
                    'catalogues' => CompanyCatalogue::paginate(12)
                ]);
            }
        }
    }
}
