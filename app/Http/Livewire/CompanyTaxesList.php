<?php

namespace App\Http\Livewire;

use App\Models\CompanyTax;
use Livewire\WithPagination;

class CompanyTaxesList extends LiveNotify
{
    use WithPagination;
    protected $listeners = [
        'refreshCompanyTaxList' => '$refresh',
        'delete'                => 'delete'
    ];

    public $search;
    public $searchResult;

    public $company;

    public function mount($company){
        $this->company = $company;
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
        return $this->confirmDelete('warning', 'Are really sure to delete?', 'Press ok to continue', $id);
    }

    public function delete($id){
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
