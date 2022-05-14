<?php

use App\Http\Controllers\View\Auth\AuthViewController;
use App\Http\Controllers\View\Company\CompanyProductViewController;
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

Route::get('/',                                   [AuthViewController::class, 'login'])->name('login');
Route::get('/login',                              [AuthViewController::class, 'login']);
Route::get('/sign-in',                            [AuthViewController::class, 'login'])->name('sign-in');
Route::get('/sign-out',                           [AuthViewController::class, 'logout'])->name('sign-out');
Route::get('/sign-up',                            [AuthViewController::class, 'register'])->name('sign-up');
Route::get('/verify-email/{token}',               [AuthViewController::class, 'verify'])->name('verify-email');
Route::get('/verify-changed-email/{token}',       [AuthViewController::class, 'verifyChangedEmail'])->name('verify-changed-email');


Route::get('/markets/{company_id}/{product_slug}',                      [CompanyProductViewController::class, 'productPublicShowCase']);
