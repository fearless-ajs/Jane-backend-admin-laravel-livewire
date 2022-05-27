<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyContactList extends Component
{
    public $company;

    use WithPagination;

    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = Contact::where('company_id', $this->company->id)->where('mobile_phone', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-contact-list', [
                'contacts' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-contact-list', [
                'contacts' => Contact::where('company_id', $this->company->id)->paginate(10)
            ]);
        }
    }
}
