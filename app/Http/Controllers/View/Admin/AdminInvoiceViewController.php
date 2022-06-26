<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminInvoiceViewController extends Controller
{

    public function invoices(){
        $data = [
            'title' => 'Invoices',
            'keywords' => 'invoices',
            'description' => 'Invoices'
        ];
        return view('livewire.admin.pages.admin-invoices-list-page', ['data' => $data]);
    }


    public function invoicePreview($invoice_id){
        $invoice = Invoice::find($invoice_id);
        $data = [
            'title' => 'Invoice',
            'keywords' => 'Products',
            'description' => 'Products'
        ];
        return view('livewire.admin.pages.admin-invoice-preview-page', ['data' => $data, 'invoice' => $invoice]);
    }

    public function invoiceEdit($invoice_id){
        $invoice = Invoice::find($invoice_id);
        $data = [
            'title' => 'Invoice',
            'keywords' => 'Products',
            'description' => 'Products'
        ];
        return view('livewire.admin.pages.admin-edit-invoice-page', ['data' => $data, 'invoice' => $invoice]);
    }

}
