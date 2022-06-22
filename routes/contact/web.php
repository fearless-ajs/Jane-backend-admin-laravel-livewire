<?php

use App\Http\Controllers\View\Admin\AdminViewController;
use App\Http\Controllers\View\Contact\ContactCatalogueViewController;
use App\Http\Controllers\View\Contact\ContactInvoiceViewController;
use App\Http\Controllers\View\Contact\ContactViewController;
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




Route::middleware(['auth', 'check-two-factor'])->name('contact.')->group(function () {

    Route::middleware('role:customer')->group(function (){
        Route::get('/',                                     [ContactViewController::class, 'dashboard'])->name('dashboard');
        Route::get('/invoices/signed',                      [ContactInvoiceViewController::class, 'signedInvoices'])->name('signed-invoices');
        Route::get('/invoices/unsigned',                    [ContactInvoiceViewController::class, 'unSignedInvoices'])->name('unsigned-invoices');
        Route::get('/invoices/{invoice_id}',                [ContactInvoiceViewController::class, 'previewInvoice'])->name('invoices-preview');

        Route::get('/catalogues',                           [ContactCatalogueViewController::class, 'catalogues'])->name('catalogues');
        Route::get('/catalogues/{catalogue_id}',            [ContactCatalogueViewController::class, 'catalogueDetails'])->name('catalogue-details');

    });

});

