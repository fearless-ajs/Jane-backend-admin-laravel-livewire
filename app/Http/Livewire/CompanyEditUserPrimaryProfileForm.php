<?php

namespace App\Http\Livewire;

use App\Mail\UserMailChanged;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Worker;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditUserPrimaryProfileForm extends LiveNotify
{
    use WithFileUploads, FileManager;
    public $user;

    public $lastname;
    public $firstname;
    public $email;
    public $image;


    public $worker;
    public $phone;

    public $city;
    public $state;
    public $country;
    public $address;

    public function mount($user){
        $this->user = $user;
        $this->worker = $user->worker;
        $this->generateFormData();
        $this->generateWorkerFormData();
    }

    public function generateFormData(){
        $this->lastname  = $this->user->lastname;
        $this->firstname = $this->user->firstname;
        $this->email     = $this->user->email;
    }


    public function generateWorkerFormData(){
        $this->phone = $this->worker->phone;
        $this->city = $this->worker->city;
        $this->state = $this->worker->state;
        $this->country = $this->worker->country;
        $this->address = $this->worker->address;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email', // Don't check the user with tha id
            'image'                 => 'nullable|image|max:5000',
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);
    }

    public function updateUser(){
        $this->validate([
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email', // Don't check the user with tha id
            'image'                 => 'nullable|image|max:5000',
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
        ]);

        // Check if the email is taken
//        if (User::where([
//            ['email', '==', $this->email],
//            ['id', '!=', $this->user->id]
//        ])->first()){
//            return $this->alert('error', 'Email', 'The email selected has been taken already');
//        }

        if (User::where('email', '=', $this->email)->where('id', '!=', $this->user->id)->first()){
            return $this->alert('error', 'Email', 'The email selected has been taken already');
        }

        if ($this->image){
            $this->image =  $this->saveUserAvatar($this->image, 'images');
        }

        Worker::where('id', $this->worker->id)->update([
            'phone'                 => $this->phone,
            'country'               => $this->country,
            'state'                 => $this->state,
            'city'                  => $this->city,
            'address'               => $this->address,
        ]);

        User::where('id', $this->user->id)->update([
            'lastname'      => $this->lastname,
            'firstname'     => $this->firstname,
            'email'         => $this->email,
            'image'         => (!$this->image)?$this->user->image:$this->image
        ]);

        // Check if the email changed and change the status to unverified
        if ($this->email !== $this->user->email){
            if (!$this->user->hasRole('super-admin')){
                $token  = Str::random(50);
                User::where('id', $this->user->id)->update([
                    'email_verified_at'     => NULL,
                    'verification_token'    => $token,
                    'enabled'               => false
                ]);
                $user = User::find($this->user->id);
                Mail::to($this->email)->send(new UserMailChanged($user, $token));
                $this->emit('refreshCompanyMyUserUserProfile');
                $this->emit('close-current-modal');
                return $this->alert('success', 'Profile updated', 'please check your email to verify your email');
            }
        }



        $this->emit('refreshCompanyMyUserUserProfile');
        $this->emit('close-current-modal');
        $this->emit('refreshAdminAppHeader');
        $this->emit('refreshContactMyProfile');
        $this->emit('refreshContactAppHeader');
        $this->emit('refreshCompanyAppHeader');
        return $this->alert('success', 'Profile updated');
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-user-primary-profile-form');
    }
}
