<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyServiceList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshServiceList' => '$refresh'];


    public function remove($service_id){
        $service =  Service::find($service_id);
        $service->delete();

        $this->emit('refreshServiceList');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Service removed']);
    }


    public function render()
    {
        return view('livewire.company.components.company-service-list', [
            'services' => Service::where('company_id', Auth::user()->company_id)->paginate(100)
        ]);
    }
}
