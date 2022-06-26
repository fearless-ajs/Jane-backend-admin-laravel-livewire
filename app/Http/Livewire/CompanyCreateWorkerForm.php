<?php

namespace App\Http\Livewire;

use App\Mail\NewWorkerMail;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use App\Models\User;
use App\Models\Worker;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CompanyCreateWorkerForm extends LiveNotify
{
    use FileManager, WithFileUploads;

    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $country;
    public $state;
    public $city;
    public $address;
    public $role;
    public $password;
    public $password_confirmation;
    public $image;

    public $roles;

    public function mount(){
        $this->fetchData();
    }

    public function updated($field){
        $this->validateOnly($field, [
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'phone'                 => 'required|numeric',
            'image'                 => 'nullable|image',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
            'role'                  => 'required|numeric',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',
        ]);
    }

    public function fetchData(){
        $this->roles  = CompanyRole::where('company_id', Auth::user()->company_id)->get();
    }

    public function create(){
        $this->validate([
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'phone'                 => 'required|numeric',
            'image'                 => 'nullable|image',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
            'role'                  => 'required|numeric',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',
        ]);


        if ($this->image){
            $this->image = $this->saveUserAvatar($this->image, 'images');
        }

        // Create user account
        $user = User::where('email', $this->email)->first();
        if (!$user){
            $user =  User::create([
                'lastname'           => $this->lastname,
                'firstname'          => $this->firstname,
                'email'              => $this->email,
                'user_type'          => 'Company-worker',
                'company_id'         => Auth::user()->company_id,
                'image'              => ($this->image)?$this->image:null,
                'password'           => $this->password
            ]);
        }

       // Create the Company worker profile
        Worker::create([
            'user_id'       => $user->id,
            'lastname'      => $this->lastname,
            'firstname'     => $this->firstname,
            'email'         => $this->email,
            'company_id'    => Auth::user()->company_id,
            'phone'         => $this->phone,
            'city'          => $this->city,
            'state'         => $this->state,
            'country'       => $this->country,
            'address'       => $this->address,
            'image'         => ($this->image)?$this->image:null,
        ]);

       // Create user Role
        CompanyRoleUser::create([
            'company_id'        => Auth::user()->company_id,
            'user_id'           => $user->id,
            'company_role_id'   => $this->role,
        ]);

        // Attach the general Company role to the user
        $user->attachRole('Company');

        // Mail the worker of the account creation
        try {
            retry(5, function () use ($user) {
                Mail::to($user->email)->send(new NewWorkerMail($user, Auth::user()->company));
            });
        } catch (\Exception $e) {

        }

        // Display a notification about verification link
        $this->resetExcept(['roles']);
        $this->emit('refreshWorkersList');
        $this->emit('close-current-modal');
        $this->alert('success', 'Worker created', 'A mail has been sent to the worker');
    }

    public function render()
    {
        return view('livewire.company.components.company-create-worker-form');
    }
}
