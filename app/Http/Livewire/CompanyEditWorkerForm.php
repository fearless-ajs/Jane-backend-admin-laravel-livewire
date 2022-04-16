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
    public $role=[];
    public $team=[];
    public $status;
    public $password;
    public $password_confirmation;

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


        // fetch user roles and teams

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
            'role'                  => 'array',
            'team'                  => 'array',
            'password'              => 'nullable|min:6',
            'password_confirmation' => 'required_with:password|same:password',
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
            'role'                  => 'array',
            'team'                  => 'array',
            'password'              => 'nullable|min:6',
            'password_confirmation' => 'required_with:password|same:password',
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

        // Check if new password is supplied and save the new one
        if ($this->password){
            User::where('id', $this->worker->user->id)->update([
                'password'  => $this->password
            ]);
        }


        // Check if new roles is supplied
        if(count($this->role) > 0){
            // Check if the role exist first then ignore
            foreach ($this->role as $role){
                if (!CompanyRoleUser::where('user_id', $this->worker->user_id)
                    ->where('company_role_id', $role)
                    ->where('company_id', Auth::user()->company_id)->first())
                {
                    CompanyRoleUser::create([
                        'company_id'        => Auth::user()->company_id,
                        'user_id'           => $this->worker->user->id,
                        'company_role_id'   => $role,
                    ]);
                }
            }

        }

        // Check if new teams is supplied
        if(count($this->team) > 0){
            // Check if the team exist first then ignore
            foreach ($this->team as $team){
                if (!CompanyTeamUser::where('user_id', $this->worker->user_id)
                    ->where('company_team_id', $team)
                    ->where('company_id', Auth::user()->company_id)->first())
                {
                    CompanyTeamUser::create([
                        'company_id'        => Auth::user()->company_id,
                        'user_id'           => $this->worker->user_id,
                        'company_team_id'   => $team,
                    ]);
                }
            }
        }

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
