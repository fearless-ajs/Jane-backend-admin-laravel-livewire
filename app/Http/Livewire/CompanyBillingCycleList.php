<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyBillingCycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyBillingCycleList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshCompanyBillingCycleList' => '$refresh'];

    public $search;
    public $searchResult;

    public $company;

    public function mount(){
        $this->company = Company::find(Auth::user()->company_id);
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
