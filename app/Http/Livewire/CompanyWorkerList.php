<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyWorkerList extends LiveNotify
{
    use WithPagination;

    protected $listeners = [
        'refreshWorkersList' => '$refresh',
        'delete'             => 'delete'
    ];

    public $search;
    public $searchResult;
    public $company;

    public function mount(){
        $this->company = Company::find(Auth::user()->company_id);
    }

    public function updated(){
        if ($this->search){
            $this->searchResult = Worker::where('company_id', $this->company->id)->where('lastname', 'LIKE', "%{$this->search}%")->orWhere('firstname', 'LIKE', "%{$this->search}%")->get();
        }
    }

    public function delete($contact_id){
        $worker = Worker::find($contact_id);

        // Delete contact itself
        $worker->delete();

        return $this->emit('alert', ['type' => 'success', 'message' => 'Staff deleted']);
    }


    public function remove($contact_id){
        return $this->confirmDelete('warning', 'Do you really want to delete?', 'Press ok to continue', $contact_id);
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
                'workers' => Worker::orderBy('id', 'DESC')->where('company_id', $this->company->id)->paginate(12)
            ]);
        }
    }
}
