<?php

namespace App\Http\Controllers\View\Contact;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class ContactInvoiceViewController extends Controller
{

    public function signedInvoices (){
        $data = [
            'title' => 'Contact Signed invoices',
            'keywords' => 'Contact Signed invoices',
            'description' => 'Contact Signed invoices'
        ];
        return view('livewire.contact.pages.contact-signed-invoices-list-page', ['data' => $data]);
    }

    public function unSignedInvoices (){
        $data = [
            'title' => 'Contact Un-Signed invoices',
            'keywords' => 'Contact Un-Signed invoices',
            'description' => 'Contact Un-Signed invoices'
        ];
        return view('livewire.contact.pages.contact-unsigned-invoices-list-page', ['data' => $data]);
    }

    public function previewInvoice($invoice_id){
        $invoice = Invoice::find($invoice_id);
        $data = [
            'title' => 'Contact Un-Signed invoices',
            'keywords' => 'Contact Un-Signed invoices',
            'description' => 'Contact Un-Signed invoices'
        ];
        return view('livewire.contact.pages.contact-invoice-preview-page', ['data' => $data, 'invoice' => $invoice]);
    }

    public function invoiceOrders ($invoice_id){
        $data = [
            'title' => 'Invoice Orders',
            'keywords' => 'Invoice orders',
            'description' => 'Invoice orders',
        ];
        return view('livewire.contact.pages.contact-invoice-order-list-page', ['data' => $data, 'invoice_id' => $invoice_id]);
    }

}
