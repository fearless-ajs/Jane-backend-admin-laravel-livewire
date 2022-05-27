<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AdminMainMenu extends Component
{
    public $settings;
    protected $listeners = ['refreshAdminMainMenu' => '$refresh'];

    public function mount(){
        $this->settings = Setting::first();
    }

    public function render()
    {
        return view('livewire.layouts.admin.admin-main-menu');
    }
}
