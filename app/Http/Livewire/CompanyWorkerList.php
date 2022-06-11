<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyWorkerList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshWorkersList' => '$refresh'];

    public $search;
    public $searchResult;
    public $company;

    public function mount(){
        $this->company = Company::find(Auth::user()->company_id);
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = Worker::where('company_id', $this->company->id)->where('phone', 'LIKE', "%{$this->search}%")->get();
        }
    }


    public function render()
    {
        if ($this->searchResult && !empty($this->search)){
            return view('livewire.company.components.company-worker-list', [
                'workers' => $this->searchResult
            ]);
        }else {
            $this->searchResult = false;
            return view('livewire.company.components.company-worker-list', [
                'workers' => Worker::orderBy('id', 'DESC')->where('company_id', $this->company->id)->paginate(2)
            ]);
        }
    }
}
