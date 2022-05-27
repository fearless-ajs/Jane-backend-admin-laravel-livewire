<?php

namespace App\Http\Livewire;

use App\Models\ServiceImage;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class CompanyServiceDetails extends Component
{

    public $service;
    protected $listeners = ['refreshServiceDetails' => '$refresh'];

    public function mount($service){
        $this->service = $service;
    }
    public function removeImage($serviceImageId){
        $image = ServiceImage::find($serviceImageId);

        // Prevent from deleting last Image
        if (count($image->service->images) <= 1){
            return   $this->emit('alert', ['type' => 'error', 'message' => 'You cannot delete the last service image']);
        }

        // remove product image
        File::delete($this->service->serviceImage);

        $image->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Product image deleted']);
        return  $this->emit('refreshServiceDetails');
    }

    public function render()
    {
        return view('livewire.company.components.company-service-details');
    }
}
