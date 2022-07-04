<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\CompanyPermission;
use App\Models\CompanyRole;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminContactViewController extends Controller
{

    public function contacts(){
        $data = [
            'title' => 'Contacts',
            'keywords' => 'Contacts',
            'description' => 'Contacts'
        ];
        return view('livewire.admin.pages.admin-contacts-list-page', ['data' => $data]);
    }

    public function contactProfile($id){
        $contact = Contact::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-contacts-info-page', ['data' => $data, 'contact' => $contact]);
    }
}
