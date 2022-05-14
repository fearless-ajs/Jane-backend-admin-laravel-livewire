<?php

namespace App\Http\Livewire;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class SignUpForm extends LiveNotify
{
    public $firstname;
    public $lastname;
    public $email;
    public $terms;
    public $password;
    public $password_confirmation;

    public function updated($field){
        $this->validateOnly($field, [
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',
            'terms'                 => 'required'
        ]);
    }

    public function register(){
        $this->validate([
            'lastname'              => 'required|string|max:255',
            'firstname'             => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',
            'terms'                 => 'required'
        ]);

      $user =  User::create([
           'lastname'           => $this->lastname,
           'firstname'          => $this->firstname,
           'email'              => $this->email,
           'user_type'          => 'Company-worker',
           'verification_token' => Str::random(50),
           'password'           => $this->password
        ]);

      // Create a company profile


        try {
            retry(5, function () use ($user) {
                Mail::to($user->email)->send(new WelcomeMail($user));
            });
        } catch (\Exception $e) {

        }
        // Display a notification about verification link
        $this->reset();
        $this->alert('success', 'User registered', 'please check your email to verify your account');
    }

    public function render()
    {
        return view('livewire.auth.components.sign-up-form');
    }
}
