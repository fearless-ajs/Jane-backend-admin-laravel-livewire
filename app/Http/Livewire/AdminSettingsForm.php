<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminSettingsForm extends LiveNotify
{
    use WithFileUploads;
    public $app_name;
    public $app_email;
    public $app_currency;
    public $app_currency_symbol;
    public $app_logo;
    public $app_country;

    public $settings;
    public $user;

    protected $listeners = [
        'refreshAdminSettings' =>   '$refresh',
        'acceptTwoFactor'   => 'acceptTwoFactorAuthentication'
    ];

    public function mount(){
        $this->fetchFormData();
        $this->user = User::find(Auth::user()->id);
    }



    public function fetchFormData(){
        $this->settings = Setting::first();
        if ($this->settings){
            $this->app_name             =   $this->settings->app_name;
            $this->app_email            =   $this->settings->app_email;
            $this->app_currency         =   $this->settings->app_currency;
            $this->app_currency_symbol  =   $this->settings->app_currency_symbol;
            $this->app_country          =   $this->settings->app_country;
            $this->app_name             =   $this->settings->app_name;
        }
    }

    public function updated($field){
        $this->validateOnly($field, [
           'app_name'              =>  'required|string|max:30',
           'app_email'             => 'required|email',
           'app_currency'          => 'required|string|max:50',
           'app_currency_symbol'   =>  'required|string|max:2',
           'app_logo'              => 'nullable|image|max:2000',
           'app_country'           => 'required|string|max:255'
        ]);
    }

    public function updateSetting(){
        $this->validate([
            'app_name'              =>  'required|string|max:30',
            'app_email'             => 'required|email',
            'app_currency'          => 'required|string|max:50',
            'app_currency_symbol'   =>  'required|string|max:2',
            'app_logo'              => 'nullable|image|max:2000',
            'app_country'           => 'required|string|max:255'
        ]);


        if ($this->app_logo){
            $this->app_logo = $this->app_logo->store('/', 'images');
            // Delete old image
            if ($this->settings->app_logo != null && $this->settings->app_logo != 'app-avatar.jpg'){
                // Delete product image
                File::delete($this->settings->AppImage);
            }
        }

        Setting::first()->update([
            'user_id'               =>  Auth::id(),
            'app_name'              =>  $this->app_name,
            'app_email'             =>  $this->app_email,
            'app_currency'          =>  $this->app_currency,
            'app_currency_symbol'   =>  $this->app_currency_symbol,
            'app_logo'              =>  ($this->app_logo)?$this->app_logo:$this->settings->app_logo,
            'app_country'           =>  $this->app_country
        ]);

        $this->emit('refreshAdminSettings');
        $this->emit('refreshAdminMainMenu');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Settings updated']);
    }

    public function requestTwoFactorAuthentication(){
        if ($this->user->enable_two_factor){
            $this->confirmRequest('warning', 'Do you want to disable two factor Auth', 'Press ok to continue');
        }else{
            $this->confirmRequest('warning', 'Do you want to activate two factor Auth', 'Press ok to continue');
        }
    }


    public function acceptTwoFactorAuthentication(){
        if ($this->user->enable_two_factor){
            $this->user->enable_two_factor = false;
            $this->user->save();
            $this->emit('refreshAdminSettings');
            return $this->alert('success', 'Two factor authentication disabled');
        }

        $this->user->enable_two_factor = true;
        $this->user->save();
        $this->emit('refreshAdminSettings');
        return $this->alert('success', 'Two factor authentication enabled');
    }

    public function render()
    {
        return view('livewire.admin.components.admin-settings-form');
    }
}
