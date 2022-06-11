<?php

namespace App\Http\Livewire;

use App\Models\CompanyCatalogue;
use App\Models\CompanyCatalogueImage;
use App\Traits\FileManager;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class CompanyCatalogueDetails extends Component
{
    use FileManager;
    public $catalogue;
    protected $listeners = ['refreshCatalogueDetails' => '$refresh'];

    public function mount($catalogue){
        $this->catalogue = CompanyCatalogue::find($catalogue->id);
    }

    public function removeImage($catalogueImageId){
        $image = CompanyCatalogueImage::find($catalogueImageId);

        // Prevent from deleting last Image
        if (count($image->catalogue->images) <= 1){
            return   $this->emit('alert', ['type' => 'error', 'message' => 'You cannot delete the last catalogue image']);
        }

        // remove product image
        $this->deleteCatalogueImage($image->image);

        $image->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Catalogue image deleted']);
        return  $this->emit('refreshCatalogueDetails');
    }

    public function render()
    {
        return view('livewire.company.components.company-catalogue-details');
    }
}
