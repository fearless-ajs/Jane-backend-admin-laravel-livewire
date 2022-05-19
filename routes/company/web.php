<?php

use App\Http\Controllers\View\Admin\AdminViewController;
use App\Http\Controllers\View\Company\CompanyContactViewController;
use App\Http\Controllers\View\Company\CompanyInvoiceViewController;
use App\Http\Controllers\View\Company\CompanyPermissionsViewController;
use App\Http\Controllers\View\Company\CompanyProductViewController;
use App\Http\Controllers\View\Company\CompanyRolesViewController;
use App\Http\Controllers\View\Company\CompanyServiceViewController;
use App\Http\Controllers\View\Company\CompanyTeamsViewController;
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

Route::middleware('auth')->name('company.')->group(function () {
    Route::get('/invoices/print/{id}',      [CompanyInvoiceViewController::class, 'printInvoice'])->name('print-invoice');
    Route::middleware('role:company')->group(function (){
        // Current user information
        Route::get('/auth/user/profile',        [CompanyUsersViewController::class, 'myProfile'])->name('my-profile');

        // Roles based access control routes
        Route::get('/roles',                    [CompanyRolesViewController::class, 'roles'])->name('roles');
        Route::get('/teams',                    [CompanyTeamsViewController::class, 'teams'])->name('teams');
        Route::get('/permissions',              [CompanyPermissionsViewController::class, 'permissions'])->name('permissions');

        Route::get('/',                         [CompanyViewController::class, 'dashboard'])->name('dashboard');
        Route::get('/users',                    [CompanyViewController::class, 'usersList'])->name('users');
        Route::get('/workers',                  [CompanyusersViewController::class, 'workers'])->name('workers');
        Route::get('/workers/{id}',             [CompanyusersViewController::class, 'workerProfile'])->name('workers.profile');

        Route::get('/contacts',                 [CompanyContactViewController::class, 'contacts'])->name('contacts');
        Route::get('/contacts/{id}',            [CompanyContactViewController::class, 'contactProfile'])->name('contacts.profile');

        Route::get('/products',                 [CompanyProductViewController::class, 'products'])->name('products');
        Route::get('/products/{id}',            [CompanyProductViewController::class, 'productDetails'])->name('product-details');

        Route::get('/categories',               [CompanyProductViewController::class, 'categories'])->name('categories');

        Route::get('/services',                 [CompanyServiceViewController::class, 'services'])->name('services');
        Route::get('/services/{id}',            [CompanyServiceViewController::class, 'serviceDetails'])->name('service-details');

        Route::get('/invoices',                 [CompanyInvoiceViewController::class, 'invoices'])->name('invoices');
        Route::get('/invoices/{id}',            [CompanyInvoiceViewController::class, 'previewInvoice'])->name('preview-invoice');
        Route::get('/invoices/edit/{id}',       [CompanyInvoiceViewController::class, 'editInvoice'])->name('edit-invoice');
        Route::get('/create-invoice',           [CompanyInvoiceViewController::class, 'createInvoice'])->name('create-invoice');

        Route::get('/settings',                 [CompanyViewController::class, 'settings'])->name('settings');

    });
});

