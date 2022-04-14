<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
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


        // Attach Company role to user
        $user->attachRole('Company');
        // Create a Company profile
        $company =  Company::create([
           'user_id'     => $user->id,
           'name'        =>  $user->lastname . ' ' . $user->firstname,
           'email'       =>  $user->email,
        ]);

       // Create a default super-admin Company role
        $company_role = CompanyRole::create([
           'company_id' => $company->id,
           'display_name'  => 'Super Administrator',
           'name'          => 'super-administrator',
           'description'   => 'This is the general overseer of the Company, usually the creator of the Company account'
       ]);

        // Create a default Company Administrative team
        $company_team = CompanyTeam::create([
            'company_id'    => $company->id,
            'display_name'  => 'Administrator',
            'name'          => 'administrator',
            'description'   => 'This is the team Company administrators'
        ]);

        // Set the new user to super admin of the Company
        CompanyRoleUser::create([
            'company_id'        => $company->id,
            'user_id'           => $user->id,
            'company_role_id'   => $company_role->id,
            'company_team_id'   => $company_team->id
        ]);

        $user->company_id = $company->id;
        $user->save();

        $this->success = true;
        $this->loading = false;
        return true;
    }


    public function render()
    {
        return view('livewire.auth.components.verify-email-card');
    }
}
