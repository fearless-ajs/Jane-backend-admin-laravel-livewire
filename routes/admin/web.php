<?php

use App\Http\Controllers\View\Admin\AdminCatalogueViewController;
use App\Http\Controllers\View\Admin\AdminCompanyViewController;
use App\Http\Controllers\View\Admin\AdminContactViewController;
use App\Http\Controllers\View\Admin\AdminCurrencyViewController;
use App\Http\Controllers\View\Admin\AdminInvoiceViewController;
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

        Route::get('/contacts',                                                 [AdminContactViewController::class, 'contacts'])->name('contacts');
        Route::get('/contacts/{contact_id}',                                    [AdminContactViewController::class, 'contactProfile'])->name('contact-profile');

        Route::get('/companies',                                                [AdminCompanyViewController::class, 'companies'])->name('companies');
        Route::get('/companies/{id}',                                           [AdminCompanyViewController::class, 'companyProfile'])->name('company-profile');
        Route::get('/companies/settings/{id}',                                  [AdminCompanyViewController::class, 'companySettings'])->name('company-settings');

        Route::get('/companies/{company_id}/contacts',                          [AdminCompanyViewController::class, 'companyContacts'])->name('company-contacts');
        Route::get('/companies/contacts/profile/{contact_id}',                  [AdminCompanyViewController::class, 'companyContactProfile'])->name('company-contact-profile');

        Route::get('/companies/{company_id}/users',                             [AdminCompanyViewController::class, 'companyUsers'])->name('company-users');
        Route::get('/companies/users/profile/{user_id}',                        [AdminCompanyViewController::class, 'companyUserProfile'])->name('company-user-profile');

//        Route::get('/companies/{company_id}/products',                           [AdminCompanyViewController::class, 'companyProducts'])->name('company-products');
//        Route::get('/companies/products/details/{product_id}',                   [AdminCompanyViewController::class, 'companyProductDetails'])->name('company-product-details');

        Route::get('/companies/{company_id}/catalogues',                        [AdminCompanyViewController::class, 'companyCatalogues'])->name('company-catalogues');
        Route::get('/companies/catalogues/details/{catalogue_id}',              [AdminCompanyViewController::class, 'companyCatalogueDetails'])->name('company-catalogue-details');

        Route::get('/companies/{company_id}/categories',                        [AdminCompanyViewController::class, 'companyCategories'])->name('company-categories');
        Route::get('/companies/{company_id}/billing-cycles',                    [AdminCompanyViewController::class, 'companyBillingCycles'])->name('company-billing-cycles');
        Route::get('/companies/{company_id}/taxes',                             [AdminCompanyViewController::class, 'companyTaxes'])->name('company-taxes');

        // Company Roles and permissions
        Route::get('/companies/{company_id}/permissions',                        [AdminCompanyViewController::class, 'companyPermissions'])->name('company-permissions');
        Route::get('/companies/permissions/{company_permission_id}/details',     [AdminCompanyViewController::class, 'companyPermissionDetails'])->name('company-permission-details');
        Route::get('/companies/{company_id}/roles',                              [AdminCompanyViewController::class, 'companyRoles'])->name('company-roles');
        Route::get('/companies/roles/{company_permission_id}/details',           [AdminCompanyViewController::class, 'companyRoleDetails'])->name('company-role-details');

//        Route::get('/companies/{company_id}/services',                          [AdminCompanyViewController::class, 'companyServices'])->name('company-services');
//        Route::get('/companies/services/details/{service_id}',                  [AdminCompanyViewController::class, 'companyServiceDetails'])->name('company-service-details');

        Route::get('/companies/{company_id}/invoices',                          [AdminCompanyViewController::class, 'companyInvoices'])->name('company-invoices');
        Route::get('/companies/{company_id}/create-invoice',                    [AdminCompanyViewController::class, 'companyCreateInvoices'])->name('company-create-invoice');
        Route::get('/companies/invoices/preview/{invoice_id}',                  [AdminCompanyViewController::class, 'companyInvoicePreview'])->name('company-invoice-preview');
        Route::get('/companies/invoices/edit/{invoice_id}',                     [AdminCompanyViewController::class, 'companyInvoiceEdit'])->name('company-invoice-edit');


        Route::get('/products',                                                  [AdminCatalogueViewController::class, 'products'])->name('products');
        Route::get('/services',                                                  [AdminCatalogueViewController::class, 'services'])->name('services');
        Route::get('/catalogues/{catalogue_id}',                                 [AdminCatalogueViewController::class, 'catalogueDetails'])->name('catalogue-details');


        Route::get('/invoices',                                                  [AdminInvoiceViewController::class, 'invoices'])->name('invoices');
        Route::get('/invoices/preview/{invoice_id}',                             [AdminInvoiceViewController::class, 'invoicePreview'])->name('invoice-preview');
        Route::get('/invoices/edit/{invoice_id}',                                [AdminInvoiceViewController::class, 'invoiceEdit'])->name('edit-invoice');


        Route::get('/currencies',                                               [AdminCurrencyViewController::class, 'currencies'])->name('currencies');
        Route::get('/currencies/{id}',                                          [AdminCurrencyViewController::class, 'currencyDetails'])->name('currency-details');



    });

});


