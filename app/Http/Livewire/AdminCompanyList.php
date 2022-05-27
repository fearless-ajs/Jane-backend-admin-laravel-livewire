<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyList extends Component
{
    use WithPagination;

    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = Company::where('name', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-list', [
                'companies' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-list', [
                'companies' => Company::orderBy('id', 'DESC')->paginate(10)
            ]);
        }
    }
}
