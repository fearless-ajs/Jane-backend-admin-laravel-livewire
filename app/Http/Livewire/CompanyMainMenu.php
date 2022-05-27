<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class CompanyMainMenu extends Component
{
    public $settings;
    public function mount(){
        $this->settings = Setting::first();
    }
    public function render()
    {
        return view('livewire.layouts.company.company-main-menu');
    }
}
