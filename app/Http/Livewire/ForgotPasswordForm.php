<?php

namespace App\Http\Livewire;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class ForgotPasswordForm extends LiveNotify
{
    public $email;

    public function updated($field){
        $this->validateOnly($field, [
            'email'     =>  'required|email'
        ]);
    }

    public function sendLink(){
        $this->validate([
            'email'     =>  'required|email'
        ]);

        // Check if the email exist in the database
        $user = User::where('email', $this->email)->first();
        if (!$user){
            return $this->emit('alert', ['type' => 'error', 'message' => 'Email not found']);
        }

        // generate a reset token and send to user
        // Check if exist then update else create
        $reset = PasswordReset::where('email', $this->email)->first();
        $token = Str::random(50);
        if ($reset){
            $reset->token = $token;
            $reset->expires_at = Carbon::now()->addMinutes(10);
            $reset->save();
        }else{
            PasswordReset::create([
                'email'        => $this->email,
                'token'        => $token,
                'expires_at'   => Carbon::now()->addMinutes(10)
            ]);
        }

        // Mail the user concerning the update
        Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
        $this->reset();
        return $this->alert('success', 'Link sent', 'Reset link sent to your email address');
    }
    public function render()
    {
        return view('livewire.auth.components.forgot-password-form');
    }
}
