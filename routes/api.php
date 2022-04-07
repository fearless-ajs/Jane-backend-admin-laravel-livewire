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
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
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

Route::post('/sign-in',                                     [AuthController::class, 'login']);
Route::post('/sign-out',                                    [AuthController::class, 'logout']);
Route::post('/sign-up',                                     [AuthController::class, 'register']);

//Email verification
Route::post('/verify-contact/{token}',                         [AuthController::class, 'verifyUser']);
// Password reset
Route::post('/reset-password',                              [AuthController::class, 'resetPassword']);
Route::post('/choose-new-password/{token}',                 [AuthController::class, 'chooseNewPassword']);


Route::resource('roles',                          RoleController::class, ['except' => ['create', 'edit']]);
Route::resource('permissions',                    PermissionController::class, ['except' => ['create', 'edit']]);

// Role operations
Route::post('/attach-permission-to-role/{role}/{permission}', [RoleOperationController::class, 'attachPermissionToRole']);
Route::post('/detach-permission-from-role/{role}/{permission}', [RoleOperationController::class, 'detachPermissionFromRole']);
Route::post('/attach-role-to-contact/{role}/{contact}', [RoleOperationController::class, 'attachRoleToUser']);
Route::post('/detach-role-from-contact/{role}/{contact}', [RoleOperationController::class, 'detachRoleFromUser']);

// User
Route::resource('users', userController::class, ['except' => ['create', 'edit']]);


Route::middleware('auth:sanctum')->get('/contact', function (Request $request) {
    // Role and permissions

});
