<?php

namespace App\Http\Livewire;

use App\Models\Worker;
use Livewire\Component;

class CompanyEditUserWorkerInfoForm extends Component
{
    public $worker;
    public $phone;

    public $city;
    public $state;
    public $country;
    public $address;


    public function mount($user){
        $this->worker = $user->worker;
        $this->generateFormData();
    }

    public function generateFormData(){
        $this->phone = $this->worker->phone;
        $this->city = $this->worker->city;
        $this->state = $this->worker->state;
        $this->country = $this->worker->country;
        $this->address = $this->worker->address;
    }


    public function updated($field){
        $this->validateOnly($field, [
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);
    }

    public function updateUser(){
        $this->validate([
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);


        Worker::where('id', $this->worker->id)->update([
            'phone'                 => $this->phone,
            'country'               => $this->country,
            'state'                 => $this->state,
            'city'                  => $this->city,
            'address'               => $this->address,
        ]);

        return $this->emit('alert', ['type' => 'success', 'message' => 'Profile updated successfully']);

    }


    public function render()
    {
        return view('livewire.company.components.company-edit-user-worker-info-form');
    }
}
