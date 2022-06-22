<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompanyAppHeader extends Component
{
    protected $listeners = [
        'refreshCompanyAppHeader'   => '$refresh'
    ];

    public function render()
    {
        return view('livewire.company.layouts.company-app-header');
    }
}
