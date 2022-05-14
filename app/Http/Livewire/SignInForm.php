<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SignInForm extends Component
{
    public $email;
    public $password;

    public function updated($feild)
    {
        $this->validateOnly($feild, [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);
    }

    public function login ()
    {
        $this->validate([
            'email'  => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password]))
        {
            // Check user roles before redirecting
            if (Auth::user()->hasRole('super-admin')){
                return redirect()->intended(route('admin.dashboard'));
            }

            if (Auth::user()->hasRole('company')){
                return redirect()->intended(route('company.dashboard'));
            }

            return true;
        }

        return $this->emit('alert', ['type' => 'error', 'message' => 'invalid credentials']);
    }

    public function render()
    {
        return view('livewire.auth.components.sign-in-form');
    }
}
