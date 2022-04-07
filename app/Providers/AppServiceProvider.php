<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use App\Mail\WelcomeMail;
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
        // When a new contact is created
        User::created(function ($user){
            // retry( is used for handling communication that could fail)
            retry(5, function () use ($user) {
                Mail::to($user->email)->send(new WelcomeMail($user));
            });
        });

        // When a contact mail is changed
        User::updated(function ($user){
            if ($user->isDirty('email')){
                retry(5, function () use ($user) {
                    Mail::to($user->email)->send(new UserMailChanged($user));
                });
            }
        });
    }
}
