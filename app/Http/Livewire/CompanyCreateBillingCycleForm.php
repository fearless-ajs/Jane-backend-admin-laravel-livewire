<?php

namespace App\Http\Livewire;

use App\Models\CompanyBillingCycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyCreateBillingCycleForm extends Component
{
    public $title;
    public $days;

    public function updated($field){
        $this->validateOnly($field, [
           'title'  =>  'required|string|max:255',
           'days'   =>  'required|numeric'
        ]);
    }

    public function addCycle(){
        $this->validate([
            'title'  =>  'required|string|max:255',
            'days'   =>  'required|numeric|min:1'
        ]);

        CompanyBillingCycle::create([
           'company_id'     =>   Auth::user()->company_id,
            'title'         =>  $this->title,
            'days'          =>  $this->days
        ]);

        $this->reset();
        $this->emit('refreshCompanyBillingCycleList');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Billing cycle added to the company']);
    }

    public function render()
    {
        return view('livewire.company.components.company-create-billing-cycle-form');
    }
}
