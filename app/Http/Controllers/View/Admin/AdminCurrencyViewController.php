<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminCurrencyViewController extends Controller
{

    public function currencies(){
        $data = [
            'title' => 'System currencies',
            'keywords' => 'System currencies',
            'description' => 'System currencies'
        ];
        return view('livewire.admin.pages.admin-currency-list-page', ['data' => $data]);
    }

    public function currencyDetails($id){
        $currency = Currency::find($id);
        $data = [
            'title' => 'System currencies',
            'keywords' => 'System currencies',
            'description' => 'System currencies'
        ];
        return view('livewire.admin.pages.admin-currency-details-page', ['data' => $data, 'currency'   =>  $currency]);
    }

}
