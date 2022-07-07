<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ContactPaymentViewController extends Controller
{

    public function paymentInfo (){
        $data = [
            'title' => 'Payment Info',
            'keywords' => 'Payment Info',
            'description' => 'Payment Info'
        ];
        return view('livewire.contact.pages.contact-payment-info-page', ['data' => $data]);
    }

    public function cart (){
        $data = [
            'title' => 'My Cart',
            'keywords' => 'My Cart',
            'description' => 'My Cart'
        ];

        return view('livewire.contact.pages.contact-cart-page', ['data' => $data]);
    }

    public function checkout (){
        $data = [
            'title' => 'My Cart',
            'keywords' => 'My Cart',
            'description' => 'My Cart'
        ];

        return view('livewire.contact.pages.contact-checkout-page', ['data' => $data]);
    }

    public function orders (){
        $data = [
            'title' => 'My Cart',
            'keywords' => 'My Cart',
            'description' => 'My Cart'
        ];

        return view('livewire.contact.pages.contact-orders-page', ['data' => $data]);
    }

}
