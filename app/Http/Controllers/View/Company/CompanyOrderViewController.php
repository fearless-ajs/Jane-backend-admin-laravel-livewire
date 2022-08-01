<?php

namespace App\Http\Controllers\View\Company;

use App\Http\Controllers\Controller;
use App\Models\CartOrderCatalogue;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyCatalogue;
use App\Models\InvoiceOrderCatalogue;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyOrderViewController extends Controller
{

    public function orders (){
        $company = Company::find(Auth::user()->company_id);
        $data = [
            'title' => 'Company products',
            'keywords' => 'Company products',
            'description' => 'Company products',
        ];
        return view('livewire.company.pages.company-order-list-page', ['data' => $data, 'company' => $company]);
    }

    public function orderDetails ($orderCatalogue_id){
        $orderItem = CartOrderCatalogue::find($orderCatalogue_id);
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-order-details-page', ['data' => $data, 'item' => $orderItem]);
    }

    public function invoiceOrders ($invoice_id){
        $data = [
            'title' => 'Company products',
            'keywords' => 'Company products',
            'description' => 'Company products',
        ];
        return view('livewire.company.pages.company-invoice-order-list-page', ['data' => $data, 'invoice_id' => $invoice_id]);
    }

    public function invoiceOrderDetails ($orderCatalogue_id){
        $orderItem = InvoiceOrderCatalogue::find($orderCatalogue_id);
        $data = [
            'title' => 'Company details',
            'keywords' => 'Company details',
            'description' => 'Company details',
        ];
        return view('livewire.company.pages.company-invoice-order-details-page', ['data' => $data, 'item' => $orderItem]);
    }


}
