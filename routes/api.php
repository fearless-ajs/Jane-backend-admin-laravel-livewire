<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use App\Http\Controllers\Api\RAC\PermissionController;
use App\Http\Controllers\Api\RAC\RoleController;
use App\Http\Controllers\Api\RAC\RoleOperationController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User
Route::resource('users', userController::class, ['except' => ['create', 'edit']]);

Route::resource('roles',                          RoleController::class, ['except' => ['create', 'edit']]);
Route::resource('permissions',                    PermissionController::class, ['except' => ['create', 'edit']]);

// Role operations
Route::post('/attach-permission-to-role/{role}/{permission}', [RoleOperationController::class, 'attachPermissionToRole']);
Route::post('/detach-permission-from-role/{role}/{permission}', [RoleOperationController::class, 'detachPermissionFromRole']);
Route::post('/attach-role-to-contact/{role}/{contact}', [RoleOperationController::class, 'attachRoleToUser']);
Route::post('/detach-role-from-contact/{role}/{contact}', [RoleOperationController::class, 'detachRoleFromUser']);

Route::post('/stripe/create-customer',       [CheckoutController::class, 'createCustomer']);
Route::post('/stripe/setup-customer-intent', [CheckoutController::class, 'createStripeCustomerIntent']);
Route::get('/stripe/payment-methods',        [CheckoutController::class, 'getStripeCustomerPaymentMethods']);
Route::get('/stripe/check-invoices',         [CheckoutController::class, 'checkInvoices']);
Route::get('/stripe/send-sample-mail',         [CheckoutController::class, 'sampleMail']);


