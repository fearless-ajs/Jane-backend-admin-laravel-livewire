<?php

use App\Http\Controllers\AppModuleController;
use App\Http\Controllers\View\Auth\AuthViewController;
use App\Http\Controllers\View\Company\CompanyProductViewController;
use App\Http\Controllers\View\Error\AppErrorViewController;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
 * Initializing system settings
 */



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

Route::middleware('guest')->group(function () {
    Route::get('/',                                   [AuthViewController::class, 'login'])->name('login');
    Route::get('/login',                              [AuthViewController::class, 'login']);
    Route::get('/sign-in',                            [AuthViewController::class, 'login'])->name('sign-in');
    Route::get('/forgot-password',                    [AuthViewController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('/reset-password/{token}',             [AuthViewController::class, 'resetPassword'])->name('reset-password');
    Route::get('/sign-up',                            [AuthViewController::class, 'register'])->name('sign-up');
    Route::get('/verify-email/{token}',               [AuthViewController::class, 'verify'])->name('verify-email');
    Route::get('/verify-customer-email/{token}',      [AuthViewController::class, 'verifyCustomer'])->name('verify-customer-email');
    Route::get('/verify-changed-email/{token}',       [AuthViewController::class, 'verifyChangedEmail'])->name('verify-changed-email');
});

Route::get('/sign-out',                           [AuthViewController::class, 'logout'])->name('sign-out');

Route::middleware('auth')->group(function () {
    Route::get('/two-factor',                         [AuthViewController::class, 'twoFactor'])->name('verify-two-factor');
});

Route::get('/markets/{company_id}/{product_slug}',                      [CompanyProductViewController::class, 'productPublicShowCase']);

// Error routes
Route::get('/unauthorized-access',                                     [AppErrorViewController::class, 'unAuthorizedAccess'])->name('unauthorized-access');


// Payment routes for payStack
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');


// For stripe
Route::get('checkout','App\Http\Controllers\CheckoutController@checkout');
Route::post('checkout','App\Http\Controllers\CheckoutController@afterpayment')->name('checkout.credit-card');

