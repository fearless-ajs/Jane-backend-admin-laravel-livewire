<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class VerifyEmailCard extends LiveNotify
{
    public $loading = false;
    public $failed   = false;
    public $success   = false;
    public function mount($token){
        $this->loading = true;
        $user = User::where('verification_token', $token)->first();
        if (!$user){
            $this->loading = false;
            $this->failed  = 'Invalid verification token';
            return false;
        }

        // Update the contact registration records
        $user->verification_token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();

        // Attach company role to user
        $user->attachRole('company');
        // Create a company profile
        Company::create([
           'user_id'     => $user->id,
           'name'        =>  $user->lastname . ' ' . $user->firstname,
           'email'       =>  $user->email,
        ]);

        $this->success = true;
        $this->loading = false;
        return true;
    }


    public function render()
    {
        return view('livewire.auth.components.verify-email-card');
    }
}
