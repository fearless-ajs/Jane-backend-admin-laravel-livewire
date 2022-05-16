<?php

namespace App\Http\Livewire;

use App\Models\CompanyTransactionInfo;
use Livewire\Component;

class CompanyBankingInfoCard extends Component
{
    public $company;
    public $country;
    public $bank_name;
    public $account_number;
    public $iban;
    public $swift_code;


    public function mount($company){
        $this->company = $company;
        $this->fetchFormData();
    }

    public function fetchFormData(){
        $info = CompanyTransactionInfo::where('company_id', $this->company->id)->first();
        if ($info){
            $this->country        = $info->country;
            $this->bank_name      = $info->bank_name;
            $this->account_number = $info->account_number;
            $this->iban           = $info->iban;
            $this->swift_code     = $info->swift_code;
        }
    }

    public function updated($field){
        $this->validateOnly($field, [
           'country'        => 'required|string|max:255',
           'bank_name'      => 'required|string|max:255',
           'account_number' => 'required|numeric',
           'iban'           => 'nullable|string|max:255',
           'swift_code'     => 'nullable|string|max:255'
        ]);
    }
    public function updateInfo(){
        $this->validate([
            'country'        => 'required|string|max:255',
            'bank_name'      => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'iban'           => 'nullable|string|max:255',
            'swift_code'     => 'nullable|string|max:255'
        ]);

       CompanyTransactionInfo::where('company_id', $this->company->id)->update([
           'country'        => $this->country,
           'bank_name'      => $this->bank_name,
           'account_number' => $this->account_number,
           'iban'           => $this->iban,
           'swift_code'     => $this->swift_code
       ]);

        return $this->emit('alert', ['type' => 'success', 'message' => 'Banking info updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-banking-info-card');
    }
}
