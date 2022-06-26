<?php

namespace App\Http\Livewire;

use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use App\Models\User;
use App\Models\Worker;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditWorkerForm extends LiveNotify
{
    use WithFileUploads, FileManager;
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

    public $image;

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
        $this->lastname     = $this->worker->lastname;
        $this->firstname    = $this->worker->firstname;
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
            'image'                 => 'nullable|image',
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
            'image'                 => 'nullable|image',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);


        // Check if image exists
        if ($this->image){
            $this->image = $this->saveUserAvatar($this->image, 'images');
            // Delete old image
            if ($this->worker->image != null && $this->worker->image != 'user-avatar.jpg'){
                // Delete product image
                File::delete($this->worker->WorkerImage);
            }
        }

        // Save Worker information
        Worker::where('id', $this->worker->id)->update([
            'lastname'      => $this->lastname,
            'firstname'     => $this->firstname,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'city'          => $this->city,
            'state'         => $this->state,
            'country'       => $this->country,
            'address'       => $this->address,
            'image'         => ($this->image)?$this->image:$this->worker->image,
            'available'     => $this->status
        ]);

        // save primary information
//        User::where('id', $this->worker->user->id)->update([
//            'lastname'           => $this->lastname,
//            'firstname'          => $this->firstname,
//            'email'              => $this->email,
//        ]);


        // Refresh the edit component
        $this->emit('refreshWorkerEditForm');
        // Update the basic info card
        $this->emit('refreshWorkerBasicInfoCard');
        $this->emit('close-current-modal');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker information updated']);
    }


    public function render()
    {
        return view('livewire.company.components.company-edit-worker-form');
    }
}
