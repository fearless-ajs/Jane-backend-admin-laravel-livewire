<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyBillingCycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyBillingCycleList extends LiveNotify
{
    use WithPagination;
    protected $listeners = [
        'refreshCompanyBillingCycleList' => '$refresh',
        'delete'                         => 'delete'
    ];

    public $search;
    public $searchResult;

    public $company;

    public function mount($company){
        $this->company = $company;
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = CompanyBillingCycle::where('company_id', $this->company->id)->where('title', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function edit($billingCycleId){
        $this->emit('editBillingCycle', $billingCycleId);
    }

    public function remove($id){
        return $this->confirmDelete('warning', 'Are really sure to delete?', 'Press ok to continue', $id);
    }

    public function delete($id){
        CompanyBillingCycle::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Billing cycle deleted']);
        return  $this->emit('refreshCompanyBillingCycleList');
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-billing-cycle-list', [
                'cycles' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-billing-cycle-list', [
                'cycles' => CompanyBillingCycle::orderBy('id', 'DESC')->where('company_id', $this->company->id)->paginate(20)
            ]);
        }
    }

}
