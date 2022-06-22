<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AdminAppHeader extends Component
{
    public $settings;
    protected $listeners = ['refreshAdminAppHeader' => '$refresh'];

    public function mount(){
        $this->settings = Setting::first();
    }


    public function render()
    {
        return view('livewire.admin.layouts.admin-app-header');
    }
}
