<?php

namespace App\Http\Livewire;

use App\Mail\UserMailChanged;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditUserPrimaryProfileForm extends LiveNotify
{
    use WithFileUploads;
    public $user;

    public $lastname;
    public $firstname;
    public $email;
    public $image;

    public function mount($user){
        $this->user = $user;
        $this->generateFormData();
    }

    public function generateFormData(){
        $this->lastname  = $this->user->lastname;
        $this->firstname = $this->user->firstname;
        $this->email     = $this->user->email;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email', // Don't check the user with tha id
            'image'                 => 'nullable|image|max:5000'
        ]);
    }

    public function updateUser(){
        $this->validate([
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email', // Don't check the user with tha id
            'image'                 => 'nullable|image|max:5000'
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
            $this->image =  $this->image->store('/', 'images');
        }

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
