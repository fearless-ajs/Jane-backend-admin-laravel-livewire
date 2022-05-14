<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\User;
use App\Models\Worker;
use App\Traits\CompanyDefaultPermissions;
use Carbon\Carbon;
use Livewire\Component;

class VerifyChangedEmailCard extends LiveNotify
{
    use CompanyDefaultPermissions;
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
        $user->enabled            = true;
        $user->save();
        // Create default roles

        $this->success = true;
        $this->loading = false;
        return true;
    }


    public function render()
    {
        return view('livewire.auth.components.verify-changed-email-card');
    }
}
