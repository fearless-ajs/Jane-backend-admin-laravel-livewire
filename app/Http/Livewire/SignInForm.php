<?php

namespace App\Http\Livewire;

use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            // Check if two factor is enabled, then generate a code
            if (Auth::user()->enable_two_factor){
                Auth::user()->generateTwoFactorCode();
                // Mail the user of the update
                $user = User::find(Auth::user()->id);
                try {
                    retry(5, function () use ($user) {
                        Mail::to($user->email)->send(new TwoFactorCodeMail($user));
                    });
                } catch (\Exception $e) {

                }

                // Redirect to the two factor page
                return redirect(route('verify-two-factor'));
            }
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
