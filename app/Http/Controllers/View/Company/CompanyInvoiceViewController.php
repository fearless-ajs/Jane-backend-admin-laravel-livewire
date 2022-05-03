<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyInvoiceViewController extends Controller
{
    public function invoices(){
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-invoices-list-page', ['data' => $data]);
    }

    public function createInvoice(){
        $data = [
            'title' => 'Company invoices',
            'keywords' => 'Company invoices',
            'description' => 'Company invoices'
        ];
        return view('livewire.company.pages.company-create-invoice-page', ['data' => $data]);
    }
}
