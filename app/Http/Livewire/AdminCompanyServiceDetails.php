<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AdminCompanyServiceDetails extends Component
{
    public $service;
    public $settings;

    public function mount($service){
        $this->settings = Setting::first();
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.admin.components.admin-company-service-details');
    }
}
