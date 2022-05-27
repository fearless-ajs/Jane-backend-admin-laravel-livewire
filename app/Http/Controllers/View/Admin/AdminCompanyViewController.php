<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminCompanyViewController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings = Setting::first();
    }

    public function companies(){
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-list-page', ['data' => $data,  'settings'  =>  $this->settings]);
    }

    public function companyProfile($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-info-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyContacts($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-contacts-list-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyContactProfile($contact_id){
//        $company = Company::find($company_id);
        $contact = Contact::find($contact_id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-contacts-info-page', ['data' => $data, 'contact' => $contact,  'settings'  =>  $this->settings]);
    }

    public function companyUsers($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-workers-list-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyUserProfile($id){
        $worker = Worker::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-workers-info-page', ['data' => $data, 'worker' => $worker,  'settings'  =>  $this->settings]);
    }

    public function companyProducts($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-products-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyProductDetails($id){
        $product = Product::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-product-details-page', ['data' => $data, 'product' => $product,  'settings'  =>  $this->settings]);
    }

    public function companyServices($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-services-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyServiceDetails($id){
        $service = Service::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-service-details-page', ['data' => $data, 'service' => $service,  'settings'  =>  $this->settings]);
    }

    public function companyInvoices($id){
        $company = Company::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-invoices-list-page', ['data' => $data, 'company' => $company,  'settings'  =>  $this->settings]);
    }

    public function companyInvoicePreview($id){
        $invoice = Invoice::find($id);
        $data = [
            'title' => 'Companies',
            'keywords' => 'Companies',
            'description' => 'Companies'
        ];
        return view('livewire.admin.pages.admin-company-invoice-preview-page', ['data' => $data, 'invoice' => $invoice,  'settings'  =>  $this->settings]);
    }
}
