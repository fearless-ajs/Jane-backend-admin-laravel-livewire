<?php

namespace App\Http\Controllers\View\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::logout();
        return redirect()->route('sign-in');
    }
}
