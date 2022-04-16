<?php

namespace App\Http\Livewire;

use App\Models\Worker;
use Livewire\Component;

class CompanyWorkerBasicInfoCard extends Component
{
    public $worker;

    protected $listeners = ['refreshWorkerBasicInfoCard' => '$refresh'];

    public function mount($worker){
        $this->worker = $worker;
    }


    public function suspendWorker(){
        Worker::where('id', $this->worker->id)->update([
            'available'     => false
        ]);

        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker suspended']);
    }

    public function activateWorker(){
        Worker::where('id', $this->worker->id)->update([
            'available'     => true
        ]);

        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker activate']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-basic-info-card');
    }
}
