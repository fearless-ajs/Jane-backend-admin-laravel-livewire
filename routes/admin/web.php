<?php

use App\Http\Controllers\View\Admin\AdminCompanyViewController;
use App\Http\Controllers\View\Admin\AdminCurrencyViewController;
use App\Http\Controllers\View\Admin\AdminViewController;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth', 'check-two-factor'])->name('admin.')->group(function () {
    Route::middleware('role:super-admin')->group(function (){

        Route::get('/',                                                         [AdminViewController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings',                                                 [AdminViewController::class, 'settings'])->name('settings');
        Route::get('/users',                                                    [AdminViewController::class, 'usersList'])->name('users');

        Route::get('/companies',                                                [AdminCompanyViewController::class, 'companies'])->name('companies');
        Route::get('/companies/{id}',                                           [AdminCompanyViewController::class, 'companyProfile'])->name('company-profile');

        Route::get('/companies/{company_id}/contacts',                          [AdminCompanyViewController::class, 'companyContacts'])->name('company-contacts');
        Route::get('/companies/contacts/profile/{contact_id}',                  [AdminCompanyViewController::class, 'companyContactProfile'])->name('company-contact-profile');

        Route::get('/companies/{company_id}/users',                             [AdminCompanyViewController::class, 'companyUsers'])->name('company-users');
        Route::get('/companies/users/profile/{user_id}',                        [AdminCompanyViewController::class, 'companyUserProfile'])->name('company-user-profile');

        Route::get('/companies/{company_id}/products',                          [AdminCompanyViewController::class, 'companyProducts'])->name('company-products');
        Route::get('/companies/products/details/{product_id}',                  [AdminCompanyViewController::class, 'companyProductDetails'])->name('company-product-details');

        Route::get('/companies/{company_id}/services',                          [AdminCompanyViewController::class, 'companyServices'])->name('company-services');
        Route::get('/companies/services/details/{service_id}',                  [AdminCompanyViewController::class, 'companyServiceDetails'])->name('company-service-details');

        Route::get('/companies/{company_id}/invoices',                          [AdminCompanyViewController::class, 'companyInvoices'])->name('company-invoices');
        Route::get('/companies/invoices/preview/{invoice_id}',                  [AdminCompanyViewController::class, 'companyInvoicePreview'])->name('company-invoice-preview');




        Route::get('/currencies',                                               [AdminCurrencyViewController::class, 'currencies'])->name('currencies');
        Route::get('/currencies/{id}',                                          [AdminCurrencyViewController::class, 'currencyDetails'])->name('currency-details');



    });

});


