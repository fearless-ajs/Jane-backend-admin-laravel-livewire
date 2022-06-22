<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\CompanyCatalogue;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ContactCatalogueViewController extends Controller
{


    public function catalogues (){
        $data = [
            'title'       => 'Catalogues',
            'keywords'    => 'Catalogues',
            'description' => 'Catalogues'
        ];
        return view('livewire.contact.pages.contact-catalogue-list-page', ['data' => $data]);
    }

    public function catalogueDetails($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        $data = [
            'title' => $catalogue->name,
            'keywords' => 'Contact catalogue',
            'description' => 'Contact catalogue'
        ];
        return view('livewire.contact.pages.contact-catalogue-details-page', ['data' => $data, 'catalogue' => $catalogue]);
    }

}
