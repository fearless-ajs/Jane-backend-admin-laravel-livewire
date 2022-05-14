<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CompanyMyUserProfile extends Component
{
    public $user;

    protected $listeners = [
      'refreshCompanyMyUserUserProfile'  => 'refreshData'
    ];
    public function mount($user){
        $this->user = $user;
    }

    public function refreshData(){
        $this->user = User::find($this->user->id);
    }

    public function render()
    {
        return view('livewire.company.components.company-my-user-profile');
    }
}
