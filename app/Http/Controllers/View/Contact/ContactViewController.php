<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ContactViewController extends Controller
{

    public function dashboard (){
        $data = [
            'title' => 'Contact dashboard',
            'keywords' => 'Contact dashboard',
            'description' => 'Contact dashboard'
        ];
        return view('livewire.contact.pages.contact-dashboard-page', ['data' => $data]);
    }

}
