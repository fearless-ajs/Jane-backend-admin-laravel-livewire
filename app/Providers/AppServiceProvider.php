<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use App\Mail\WelcomeMail;
use App\Models\CompanyModule;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserStripeSetupIntent;
use App\Traits\StripeServiceProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use StripeServiceProvider;
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
        if (! app()->runningInConsole()){
            // When a contact mail is changed
//            User::updated(function ($user){
//                if ($user->isDirty('email')){
//                    retry(5, function () use ($user) {
//                        Mail::to($user->email)->send(new UserMailChanged($user, $user->verification_token));
//                    });
//                }
//            });

            User::created(function ($user){
                //1. Create a tripe customer_id for every user
                $stripe_account = $this->createStripeCustomerAccount();

                //1b. Save the stripe_customer_id to the user record
                $user->stripe_customer_id = $stripe_account->id;
                $user->save();

                //2. Create user default stripe setup intent
                $setUp_intent = $this->setUpStripeCustomerIntent($user);
                //2b. Save the user stripe_intent info
                UserStripeSetupIntent::create([
                   'user_id'        => $user->id,
                   'intent_id'      => $setUp_intent->id,
                   'client_secret'  =>  $setUp_intent->client_secret
                ]);
            });


            view()->share('settings', Setting::first());
        }

    }

    public function createCompanyModules(){

    }
}
