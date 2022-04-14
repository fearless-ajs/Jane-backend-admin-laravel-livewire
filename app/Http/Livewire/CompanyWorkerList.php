<?php

namespace App\Http\Livewire;

use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyWorkerList extends Component
{
    use WithPagination;

    protected $listeners = ['refreshWorkersList' => '$refresh'];

    public function render()
    {
        return view('livewire.Company.components.Company-worker-list', [
           'workers'   => Worker::where('company_id', Auth::user()->company_id)->paginate(200)
        ]);
    }
}
