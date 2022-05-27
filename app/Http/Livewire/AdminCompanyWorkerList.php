<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyWorkerList extends Component
{
    use WithPagination;

    public $company;

    public $search;
    public $searchResult;

    public function updated(){
        if ($this->search){
            $this->searchResult = Worker::where('company_id', $this->company->id)->where('phone', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function mount($company){
        $this->company = $company;
    }

    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.admin.components.admin-company-worker-list', [
                'workers' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.admin.components.admin-company-worker-list', [
                'workers' => Worker::where('company_id', $this->company->id)->paginate(10)
            ]);
        }
    }
}
