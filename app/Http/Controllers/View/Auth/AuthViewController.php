<?php

namespace App\Http\Controllers\View\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthViewController extends Controller
{
    public function login (){
        $data = [
          'title' => 'Sign in',
          'keywords' => 'sign in, crm',
          'description' => 'Crm sign in area'
        ];
        return view('livewire.auth.pages.sign-in-page', ['data' => $data]);
    }

    public function twoFactor (){
        if (!Auth::user()->two_factor_code){
            // Check user roles before redirecting
            if (Auth::user()->hasRole('super-admin')){
                return redirect()->route('admin.dashboard');
            }

            if (Auth::user()->hasRole('company')){
                return redirect()->route('company.dashboard');
            }
        }
        $data = [
            'title' => 'two-factor',
            'keywords' => 'two-factor',
            'description' => 'two-factor'
        ];
        return view('livewire.auth.pages.two-factor-page', ['data' => $data]);
    }

    public function twoFactorThroughLink ($code){
        $data = [
            'title' => 'two-factor',
            'keywords' => 'two-factor',
            'description' => 'two-factor'
        ];

        $user = User::find(Auth::user()->id);


        // Check if the code exists
        if ($code != $user->two_factor_code){
            // return error message
            return redirect(route('verify-two-factor'))->with('tokenError', 'Invalid token');
        }

        // Check if the code is still valid
        if (now() >= $user->two_factor_expires_at){
            // return error message
            return redirect(route('verify-two-factor'))->with('tokenError', 'Two factor expired, please login again');
        }

        // Delete the old code
        $user->deleteTwoFactorCode();

        // Check user roles before redirecting
        if (Auth::user()->hasRole('super-admin')){
           return redirect()->intended(route('admin.dashboard'));
        }

        if (Auth::user()->hasRole('company')){
            return redirect()->intended(route('company.dashboard'));
        }
    }


    public function forgotPassword (){
        $data = [
            'title' => 'Forgot password',
            'keywords' => 'sign in, crm',
            'description' => 'Crm sign in area'
        ];
        return view('livewire.auth.pages.forgot-password-page', ['data' => $data]);
    }


    public function resetPassword ($token){
        $data = [
            'title' => 'Reset password',
            'keywords' => 'sign in, crm',
            'description' => 'Crm sign in area'
        ];
        return view('livewire.auth.pages.reset-password-page', ['data' => $data, 'token'  =>  $token]);
    }


    public function register (){
        $data = [
            'title' => 'Sign up',
            'keywords' => 'sign up, crm',
            'description' => 'Crm sign up area'
        ];
        return view('livewire.auth.pages.sign-up-page', ['data' => $data]);
    }

    public function verify ($token){
        $data = [
            'title' => 'Verify user email',
            'keywords' => 'Verify user email',
            'description' => 'Verify user email'
        ];
        return view('livewire.auth.pages.verify-email-page', ['data' => $data, 'token' => $token]);
    }

    public function verifyCustomer ($token){
        $data = [
            'title' => 'Verify user email',
            'keywords' => 'Verify user email',
            'description' => 'Verify user email'
        ];
        return view('livewire.contact.pages.verify-customer-email-page', ['data' => $data, 'token' => $token]);
    }

    public function verifyChangedEmail ($token){
        $data = [
            'title' => 'Verify user email',
            'keywords' => 'Verify user email',
            'description' => 'Verify user email'
        ];
        return view('livewire.auth.pages.verify-changed-email-page', ['data' => $data, 'token' => $token]);
    }

    public function logout() {
        // Delete the old code
        if (Auth::user()){
            Auth::user()->deleteTwoFactorCode();
            Auth::logout();
        }
        // clears the resend verification data on the login page
        Session::forget('data');

        // Redirects to login page
        return redirect()->route('sign-in');
    }
}
