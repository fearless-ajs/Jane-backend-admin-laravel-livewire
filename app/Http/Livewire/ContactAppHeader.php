<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactAppHeader extends Component
{
    protected $listeners = [
      'refreshContactAppHeader'     =>  '$refresh'
    ];

    public function render()
    {
        return view('livewire.contact.layouts.contact-app-header');
    }
}
