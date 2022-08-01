<?php

use App\Http\Controllers\View\Company\CompanyContactViewController;
use App\Http\Controllers\View\Company\CompanyInvoiceViewController;
use App\Http\Controllers\View\Company\CompanyOrderViewController;
use App\Http\Controllers\View\Company\CompanyPermissionsViewController;
use App\Http\Controllers\View\Company\CompanyProductViewController;
use App\Http\Controllers\View\Company\CompanyRolesViewController;
use App\Http\Controllers\View\Company\CompanyServiceViewController;
use App\Http\Controllers\View\Company\CompanyUsersViewController;
use App\Http\Controllers\View\Company\CompanyViewController;
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

Route::middleware(['auth', 'check-two-factor'])->name('company.')->group(function () {

    Route::get('/invoices/print/{id}',      [CompanyInvoiceViewController::class, 'printInvoice'])->name('print-invoice');
    Route::middleware('role:company')->group(function (){

        Route::get('/chart-test',                     [CompanyViewController::class, 'chartTest'])->name('chart-test');

            // Current user information
            Route::get('/auth/user/profile',        [CompanyUsersViewController::class, 'myProfile'])->name('my-profile');

            // Roles based access control routes
            Route::middleware('company-guard:role,read')->get('/roles',                    [CompanyRolesViewController::class, 'roles'])->name('roles');
            Route::middleware('company-guard:role,edit')->get('/roles/{id}',               [CompanyPermissionsViewController::class, 'roleDetails'])->name('role-details');
            Route::middleware('company-guard:role,read')->get('/permissions',              [CompanyPermissionsViewController::class, 'permissions'])->name('permissions');
            Route::middleware('company-guard:role,edit')->get('/permissions/{id}',         [CompanyPermissionsViewController::class, 'permissionDetails'])->name('permission-details');

            Route::get('/',                     [CompanyViewController::class, 'dashboard'])->name('dashboard');
            Route::middleware('company-guard:user,read')->get('/users',                    [CompanyViewController::class, 'usersList'])->name('users');
            Route::middleware('company-guard:user,read')->get('/workers',                  [CompanyusersViewController::class, 'workers'])->name('workers');
            Route::middleware('company-guard:user,read')->get('/workers/{id}',             [CompanyusersViewController::class, 'workerProfile'])->name('workers.profile');



            Route::middleware('company-guard:contact,read')->get('/contacts',                 [CompanyContactViewController::class, 'contacts'])->name('contacts');
            Route::middleware('company-guard:contact,read')->get('/contacts/{id}',            [CompanyContactViewController::class, 'contactProfile'])->name('contacts.profile');


//            Route::middleware('company-guard:product,read')->get('/products',                 [CompanyProductViewController::class, 'products'])->name('products');
//            Route::middleware('company-guard:product,read')->get('/products/{id}',            [CompanyProductViewController::class, 'productDetails'])->name('product-details');

            Route::middleware('company-guard:catalogue,read')->get('/catalogues',               [CompanyProductViewController::class, 'catalogues'])->name('catalogues');
            Route::middleware('company-guard:catalogue,read')->get('/catalogues/{id}',          [CompanyProductViewController::class, 'catalogueDetails'])->name('catalogue-details');

            Route::middleware('company-guard:catalogue,read')->get('/orders',                   [CompanyOrderViewController::class, 'orders'])->name('orders');
            Route::middleware('company-guard:catalogue,read')->get('/orders/{id}',              [CompanyOrderViewController::class, 'orderDetails'])->name('order-details');


            Route::middleware('company-guard:catalogue,read')->get('/invoice-orders/{invoice_id}',     [CompanyOrderViewController::class, 'invoiceOrders'])->name('invoice-orders');
            Route::middleware('company-guard:catalogue,read')->get('/invoice-order-details/{order_id}',     [CompanyOrderViewController::class, 'invoiceOrderDetails'])->name('invoice-order-details');

//            Route::middleware('company-guard:service,read')->get('/services',                 [CompanyServiceViewController::class, 'services'])->name('services');
//            Route::middleware('company-guard:service,read')->get('/services/{id}',            [CompanyServiceViewController::class, 'serviceDetails'])->name('service-details');

            Route::middleware('company-guard:category,read')->get('/categories',                [CompanyProductViewController::class, 'categories'])->name('categories');
            Route::middleware('company-guard:billing-cycle,read')->get('/billing-cycle',        [CompanyProductViewController::class, 'billingCycle'])->name('billing-cycles');
            Route::middleware('company-guard:tax,read')->get('/taxes',                          [CompanyProductViewController::class, 'taxes'])->name('taxes');


            Route::middleware('company-guard:invoice,read')->get('/invoices',                 [CompanyInvoiceViewController::class, 'invoices'])->name('invoices');
            Route::middleware('company-guard:invoice,read')->get('/invoices/{id}',            [CompanyInvoiceViewController::class, 'previewInvoice'])->name('preview-invoice');
            Route::middleware('company-guard:invoice,edit')->get('/invoices/edit/{id}',       [CompanyInvoiceViewController::class, 'editInvoice'])->name('edit-invoice');Route::get('/create-invoice',           [CompanyInvoiceViewController::class, 'createInvoice'])->name('create-invoice');

           Route::middleware('company-guard:system,edit')->get('/settings',                 [CompanyViewController::class, 'settings'])->name('settings');



    });
});

