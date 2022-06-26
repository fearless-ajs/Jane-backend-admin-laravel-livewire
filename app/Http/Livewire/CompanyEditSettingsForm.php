<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyEditSettingsForm extends Component
{
    use WithFileUploads;

    public $company;

    public $name;
    public $email;
    public $phone;
    public $country;
    public $state;
    public $city;
    public $address;
    public $status;
    public $banner;

    protected $listeners = ['refreshCompanyEditForm' => '$refresh'];

    public function mount($company)
    {
        $this->company = $company;
        $this->fetchData();
    }

    public function fetchData(){
        // Fetch user data
        $this->name         = $this->company->name;
        $this->email        = $this->company->email;
        $this->phone        = $this->company->phone;
        $this->status       = $this->company->available;
        $this->country      = $this->company->country;
        $this->state        = $this->company->state;
        $this->city         = $this->company->city;
        $this->address      = $this->company->address;
    }

    public function updated($field){
        $this->validateOnly($field, [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:companies,email,' . $this->company->id,
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
            'banner'                => 'nullable|image|max:5000'
        ]);
    }


    public function updateSettings(){
        $this->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:companies,email,' . $this->company->id,
            'phone'                 => 'required|numeric',
            'country'               => 'required|string|max:255',
            'state'                 => 'required|string|max:255',
            'city'                  => 'required|string|max:255',
            'address'               => 'required|string|max:255',
            'banner'                => 'nullable|image|max:5000'
        ]);

        // Let us check if an image is supplied
        if ($this->banner){
            // Save the banner
            $img = Image::make($this->banner)->resize(1980, 660)->encode('jpg');
            $name = Str::random(50).'_'.$this->banner->getClientOriginalName();
            Storage::disk('images')->put($name, $img);
            $this->banner = $name;
        }

        Company::where('id', $this->company->id)->update([
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'city'          => $this->city,
            'state'         => $this->state,
            'country'       => $this->country,
            'address'       => $this->address,
            'available'     => $this->status,
            'banner'        => ($this->banner)?$this->banner:$this->company->banner
        ]);

        // Close the edit modal
        $this->emit('close-current-modal');
        // Update the basic info card
        $this->emit('refreshCompanyBasicInfoCard');
        $this->emit('refreshAdminCompanyProfile');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Company information updated']);
    }

    public function render()
    {
        return view('livewire.company.components.company-edit-settings-form');
    }
}
