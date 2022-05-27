<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyServiceList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshServiceList' => '$refresh'];
    public $company;

    public $search;
    public $searchResult;

    public $order;

    public $categories;
    public $category;

    public function mount(){
        $this->company = Company::find(Auth::user()->company_id);
        $this->categories   =   Category::where('company_id', $this->company->id)->get();
    }

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

    public function remove($service_id){
        $service =  Service::find($service_id);

        if (count($service->images) > 0){
            foreach ($service->images as $image){
                // Delete product image
                File::delete($image->productImage);
                $image->delete();
            }
        }

        $service->delete();

        $this->emit('refreshServiceList');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service removed']);
    }


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-service-list', [
                'services' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            if ($this->category){
                if ($this->order){
                    return view('livewire.company.components.company-service-list', [
                        'services' => Service::where('company_id', $this->company->id)->where('category', $this->category)->orderBy('price', $this->order)->paginate(12)
                    ]);
                }else{
                    return view('livewire.company.components.company-service-list', [
                        'services' => Service::where('company_id', $this->company->id)->where('category', $this->category)->paginate(12)
                    ]);
                }
            }else{
                return view('livewire.company.components.company-service-list', [
                    'services' => Service::where('company_id', $this->company->id)->paginate(12)
                ]);
            }
        }
    }
}
