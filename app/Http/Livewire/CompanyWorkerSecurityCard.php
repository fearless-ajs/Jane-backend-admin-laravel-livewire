<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CompanyWorkerSecurityCard extends Component
{

    public $worker;

    public $password;
    public $password_confirmation;

    public function mount($worker){
        $this->worker = $worker;
    }

    public function showRolesAndPermissionCard(){
        $this->emit('showRolesAndPermissionCard');
    }


    public function updated($field){
        $this->validateOnly($field, [
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',
        ]);
    }

    public function updatePassword(){
         $this->validate([
            'password'              => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password',

        ]);

        User::where('id', $this->worker->user->id)->update([
            'password'  => $this->password
        ]);

        $this->reset();
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker password changed']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-security-card');
    }
}
