<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanySettings extends Component
{
    public $company;

    public $documentsCard;
    public $transactionCard;

    public function showDocumentsCard(){
        $this->documentsCard   = true;
        $this->transactionCard = false;
    }

    public function showTransactionCard(){
        $this->documentsCard   = false;
        $this->transactionCard = true;
    }

    public function mount($company){
        $this->company = $company;
        $this->showDocumentsCard();
    }


    public function render()
    {
        return view('livewire.company.components.company-settings');
    }
}
