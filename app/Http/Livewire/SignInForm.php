<?php

namespace App\Http\Livewire;

use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SignInForm extends LiveNotify
{
    public $email;
    public $password;
    public $remember;

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

        // Check email
        $user = User::where('email', $this->email)->first();

        // Check password
        if(!$user || !Hash::check($this->password, $user->password)) {
            return $this->emit('alert', ['type' => 'error', 'message' => 'invalid credentials']);
        }

        // Check if the account is verified
        if ($user->verification_token){
            return $this->alert('info', 'Unverified account', 'Please check your mailbox to verify your email');
        }

        // Log user in
        Auth::login($user, $this->remember);

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
            if (!Auth::user()->worker->available){
                return $this->alert('error', 'Suspended account', 'Your account has been suspended');
            }
            return redirect()->intended(route('company.dashboard'));
        }

        if (Auth::user()->hasRole('customer')){
            return redirect()->intended(route('contact.dashboard'));
        }

        return true;
    }

    public function render()
    {
        return view('livewire.auth.components.sign-in-form');
    }
}
