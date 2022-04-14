<?php

use App\Http\Controllers\View\Admin\AdminViewController;
use App\Http\Controllers\View\Company\CompanyPermissionsViewController;
use App\Http\Controllers\View\Company\CompanyRolesViewController;
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

Route::middleware('auth')->group(function () {
    Route::middleware('role:company')->group(function (){
        // Roles based access control routes
        Route::get('/roles',                    [CompanyRolesViewController::class, 'roles'])->name('Company.roles');
        Route::get('/teams',                    [CompanyTeamsViewController::class, 'teams'])->name('Company.teams');
        Route::get('/permissions',              [CompanyPermissionsViewController::class, 'permissions'])->name('Company.permissions');


        Route::get('/',                         [CompanyViewController::class, 'dashboard'])->name('Company');
        Route::get('/users',                    [CompanyViewController::class, 'usersList'])->name('Company.users');
        Route::get('/workers',                  [CompanyusersViewController::class, 'workers'])->name('Company.workers');
        Route::get('/workers/{id}',             [CompanyusersViewController::class, 'workerProfile'])->name('Company.workers.profile');

    });
});

