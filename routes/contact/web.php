<?php

use App\Http\Controllers\View\Admin\AdminViewController;
use App\Http\Controllers\View\Contact\ContactCatalogueViewController;
use App\Http\Controllers\View\Contact\ContactInvoiceViewController;
use App\Http\Controllers\View\Contact\ContactPaymentViewController;
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
        Route::get('/profile',                              [ContactViewController::class, 'profile'])->name('profile');


        Route::get('/invoices/signed',                      [ContactInvoiceViewController::class, 'signedInvoices'])->name('signed-invoices');
        Route::get('/invoices/unsigned',                    [ContactInvoiceViewController::class, 'unSignedInvoices'])->name('unsigned-invoices');
        Route::get('/invoices/{invoice_id}',                [ContactInvoiceViewController::class, 'previewInvoice'])->name('invoices-preview');
        Route::get('/invoice-orders/{invoice_id}',          [ContactInvoiceViewController::class, 'invoiceOrders'])->name('invoice-orders');

        Route::get('/catalogues',                           [ContactCatalogueViewController::class, 'catalogues'])->name('catalogues');
        Route::get('/catalogues/{catalogue_id}',            [ContactCatalogueViewController::class, 'catalogueDetails'])->name('catalogue-details');


        Route::get('/payment-info',                         [ContactPaymentViewController::class, 'billingAddress'])->name('payment-info');
        Route::get('/payment-method',                       [ContactPaymentViewController::class, 'paymentInfo'])->name('payment-method');

        Route::get('/cart',                                  [ContactPaymentViewController::class, 'cart'])->name('cart');
        Route::get('/checkout-now',                          [ContactPaymentViewController::class, 'checkout'])->name('checkout');
        Route::get('/orders',                                [ContactPaymentViewController::class, 'orders'])->name('orders');

        Route::get('/subscriptions',                         [ContactViewController::class, 'subscriptions'])->name('subscriptions');
        Route::get('/subscriptions/{id}',                    [ContactViewController::class, 'subscriptionDetails'])->name('subscription-details');

        Route::get('checkout','App\Http\Controllers\View\Contact\CheckoutController@checkoutCart')->name('pay-cart-for-now');
        Route::post('checkout','App\Http\Controllers\View\Contact\CheckoutController@afterCartpayment')->name('checkout.credit-card');

        Route::get('checkout-invoice/{invoice_id}','App\Http\Controllers\View\Contact\CheckoutController@checkoutInvoice')->name('pay-invoice-form-now');
        Route::post('checkout-invoice','App\Http\Controllers\View\Contact\CheckoutController@afterInvoicepayment')->name('checkout.invoice-credit-card');

    });

});

