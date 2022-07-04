<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TwoFactorThroughLink extends Component
{
    public $code;
    public $user;

    public function mount($code){
        $this->user = User::find(Auth::user()->id);
        $this->code = $code;

        $this->autoVerify();
    }

    public function verify(){
        $this->validate([
            'code'   =>  'required|numeric'
        ]);

        // Check if the code exists
        if ($this->code != $this->user->two_factor_code){
            // return error message
            return $this->emit('alert', ['type' => 'error', 'message' => 'invalid code']);
        }

        // Check if the code is still valid
        if (now() >= $this->user->two_factor_expires_at){
            // return error message
            return $this->emit('alert', ['type' => 'error', 'message' => 'Two factor expired, please login again']);
        }

        // Delete the old code
        $this->user->deleteTwoFactorCode();

        // Check user roles before redirecting
        if (Auth::user()->hasRole('super-admin')){
            return redirect()->intended(route('admin.dashboard'));
        }

        if (Auth::user()->hasRole('company')){
            return redirect()->intended(route('company.dashboard'));
        }
    }

    public function render()
    {
        return view('livewire.auth.components.two-factor-through-link');
    }
}
