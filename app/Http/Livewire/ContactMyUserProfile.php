<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactMyUserProfile extends LiveNotify
{
    public $user;

    protected $listeners = [
      'refreshContactMyProfile'     => '$refresh',
      'acceptTwoFactor'             => 'acceptTwoFactorAuthentication'
    ];

    public function mount($user){
        $this->user = $user;
    }


    public function requestTwoFactorAuthentication(){
        if ($this->user->enable_two_factor){
            $this->confirmRequest('warning', 'Do you want to disable two factor Auth', 'Press ok to continue');
        }else{
            $this->confirmRequest('warning', 'Do you want to activate two factor Auth', 'Press ok to continue');
        }
    }

    public function acceptTwoFactorAuthentication(){
        if ($this->user->enable_two_factor){
            $this->user->enable_two_factor = false;
            $this->user->save();
            $this->emit('refreshCompanyMyUserUserProfile');
            return $this->alert('success', 'Two factor authentication disabled');
        }

        $this->user->enable_two_factor = true;
        $this->user->save();
        $this->emit('refreshContactMyProfile');
        return $this->alert('success', 'Two factor authentication enabled');
    }

    public function render()
    {
        return view('livewire.contact.components.contact-my-user-profile');
    }
}
