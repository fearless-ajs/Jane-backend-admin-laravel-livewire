<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveNotify extends Component
{

    public function alert($type, $title, $text="Press Ok to Continue"){
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => $type,
            'title' => $title,
            'text' => $text
        ]);
    }

}
