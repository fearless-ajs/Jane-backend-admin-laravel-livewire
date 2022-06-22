<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyTax;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyTaxesList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshCompanyTaxList' => '$refresh'];

    public $search;
    public $searchResult;

    public $company;

    public function mount(){
        $this->company = Company::find(Auth::user()->company_id);
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyTax::where('company_id', $this->company->id)->where('title', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function edit($taxId){
        $this->emit('editTax', $taxId);
    }

    public function remove($id){
        CompanyTax::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Tax deleted']);
        return  $this->emit('refreshCompanyTaxList');
    }


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-taxes-list', [
                'taxes' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-taxes-list', [
                'taxes' => CompanyTax::orderBy('id', 'DESC')->where('company_id', $this->company->id)->paginate(20)
            ]);
        }
    }
}
