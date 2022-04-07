<?php

use App\Http\Controllers\View\Admin\AdminViewController;
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




Route::middleware('auth')->group(function () {
    Route::middleware('role:super-admin')->group(function (){
        Route::get('/',                         [AdminViewController::class, 'dashboard'])->name('admin');
        Route::get('/users',                    [AdminViewController::class, 'usersList'])->name('admin.users');



    });
});

