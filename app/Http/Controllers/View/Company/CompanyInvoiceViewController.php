<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Http\Request;

class CompanyInvoiceViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function createInvoice(){
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-create-invoice-page', ['data' => $data,  'settings'   => $this->settings]);
    }

    public function invoices(){
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-invoices-list-page', ['data' => $data,  'settings'   => $this->settings]);
    }

    public function previewInvoice($id){
        $invoice = Invoice::find($id);
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-invoice-preview-page', ['data' => $data, 'invoice' => $invoice,  'settings'   => $this->settings]);
    }

    public function printInvoice($id){
        $invoice = Invoice::find($id);
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-invoice-print-page', ['data' => $data, 'invoice' => $invoice,  'settings'   => $this->settings]);
    }

    public function editInvoice($id){
        $invoice = Invoice::find($id);
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-edit-invoice-page', ['data' => $data, 'invoice' => $invoice,  'settings'   => $this->settings]);
    }
}
