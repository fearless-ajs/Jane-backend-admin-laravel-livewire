<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Worker;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCompanyWorkerList extends LiveNotify
{
    use WithPagination;

    public $company;

    public $search;
    public $searchResult;

    protected $listeners = [
        'delete'    =>  'delete'
    ];

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
