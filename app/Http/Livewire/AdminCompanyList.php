<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class AdminCompanyList extends Component
{
    public function render()
    {
        return view('livewire.admin.components.admin-company-list', [
            'companies' => Company::all()
        ]);
    }
}
