<?php

namespace App\Http\Livewire;

use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyEditWorkerForm extends LiveNotify
{
    public $worker;

    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $country;
    public $state;
    public $city;
    public $address;
    public $status;

    public $roles;
    public $teams;


    protected $listeners = ['refreshWorkerEditForm' => '$refresh'];

    public function mount($worker)
    {
        $this->worker = $worker;
        $this->fetchData();
    }

    public function fetchData(){
        $this->roles  = CompanyRole::where('company_id', Auth::user()->company_id)->get();
        $this->teams  = CompanyTeam::where('company_id', Auth::user()->company_id)->get();

        // Fetch user data
        $this->lastname     = $this->worker->user->lastname;
        $this->firstname    = $this->worker->user->firstname;
        $this->email        = $this->worker->user->email;
        $this->phone        = $this->worker->phone;
        $this->status       = $this->worker->available;
        $this->country      = $this->worker->country;
        $this->state        = $this->worker->state;
        $this->city         = $this->worker->city;
        $this->address      = $this->worker->address;


    }

    public function updated($field){
        $this->validateOnly($field, [
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $this->worker->user->id,
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);
    }

    public function updateWorker(){
        $this->validate([
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $this->worker->user->id,
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);

        // Save Worker information
        Worker::where('id', $this->worker->id)->update([
            'phone'         => $this->phone,
            'city'          => $this->city,
            'state'         => $this->state,
            'country'       => $this->country,
            'address'       => $this->address,
            'available'     => $this->status
        ]);

        // save primary information
        User::where('id', $this->worker->user->id)->update([
            'lastname'           => $this->lastname,
            'firstname'          => $this->firstname,
            'email'              => $this->email,
        ]);


        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker information updated']);
    }


    public function render()
    {
        return view('livewire.company.components.company-edit-worker-form');
    }
}
