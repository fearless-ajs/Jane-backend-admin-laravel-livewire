<?php

namespace App\Http\Livewire;

use App\Models\CompanyBillingCycle;
use Livewire\Component;

class CompanyEditBillingCycleForm extends Component
{
    public $title;
    public $days;
    public $billingCycle;
    public $company;
    protected $listeners = ['editBillingCycle'  => 'parseFormParameters'];


    public function mount($company){
        $this->company = $company;
    }

    public function parseFormParameters($billingCycleId)
    {
        $billingCycle = CompanyBillingCycle::find($billingCycleId);
        if ($billingCycleId){
            $this->billingCycle = $billingCycle;
            $this->title        = $billingCycle->title;
            $this->days         = $billingCycle->days;
        }
    }

    public function updated($field){
        $this->validateOnly($field, [
            'title'  =>  'required|string|max:255',
            'days'   =>  'required|numeric'
        ]);
    }

    public function updateCycle(){
        $this->validate([
            'title'  =>  'required|string|max:255',
            'days'   =>  'required|numeric|min:1'
        ]);

        $this->billingCycle->update([
            'title'         =>  $this->title,
            'days'          =>  $this->days
        ]);

        $this->emit('refreshCompanyBillingCycleList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Billing cycle updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-billing-cycle-form');
    }
}
