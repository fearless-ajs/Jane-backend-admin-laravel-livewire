<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use App\Mail\WelcomeMail;
use App\Models\CompanyModule;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // When a contact mail is changed
        User::updated(function ($user){
            if ($user->isDirty('email')){
                retry(5, function () use ($user) {
                    Mail::to($user->email)->send(new UserMailChanged($user));
                });
            }
        });

//        $this->createCompanyModules();
        view()->share('settings', Setting::first());
    }

    public function createCompanyModules(){


    }
}
