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


use App\Http\Controllers\Api\Contact\AuthController;
use App\Http\Controllers\Api\Contact\CartController;
use App\Http\Controllers\Api\Contact\OrderController;
use App\Http\Controllers\Api\Contact\ProductCategoryController;
use App\Http\Controllers\Api\Contact\ProductController;
use App\Http\Controllers\Api\Contact\ServiceController;
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

Route::prefix('contact-route')->group(function () {
    Route::post('/sign-in',                                     [AuthController::class, 'login']);
    Route::post('/sign-out',                                    [AuthController::class, 'logout']);
    Route::post('/sign-up',                                     [AuthController::class, 'register']);

    //Email verification
    Route::post('/verify-contact/{token}',                      [AuthController::class, 'verifyUser']);
    // Password reset
    Route::post('/reset-password',                              [AuthController::class, 'resetPassword']);
    Route::post('/choose-new-password/{token}',                 [AuthController::class, 'chooseNewPassword']);


    Route::resource('products',                     ProductController::class, ['only' => ['index', 'show']]);
    Route::resource('services',                     ServiceController::class, ['only' => ['index', 'show']]);

    Route::get('/categories',                                 [ProductCategoryController::class, 'categories']);
    Route::get('/company/{company_id}/categories',            [ProductCategoryController::class, 'companyCategories']);
    Route::get('/category/{category_name}/products',          [ProductCategoryController::class, 'categoryProducts']);


    // Protection routes for signed in users only
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/cart/add-product/{product_id}',                                 [CartController::class, 'addProductToCart']);
        Route::post('/cart/remove-product/{product_id}',                              [CartController::class, 'removeProductFromCart']);
        Route::post('/cart/add-service/{service_id}',                                 [CartController::class, 'addServiceToCart']);
        Route::post('/cart/remove-service/{service_id}',                              [CartController::class, 'removeServiceFromCart']);
        Route::get('/cart/my-cart',                                                   [CartController::class, 'fetchUserCart']);
        Route::post('/cart/clear',                                                    [CartController::class, 'clearCart']);

        Route::post('/cart/checkout',                                                 [OrderController::class, 'checkout']);
        Route::get('/order/fetch/all-my-orders',                                      [OrderController::class, 'fetchMyOrders']);
        Route::get('/order/fetch/all-my-in-progress-orders',                          [OrderController::class, 'fetchMyInProgressOrders']);
        Route::get('/order/fetch/all-my-delivered-orders',                            [OrderController::class, 'fetchMyDeliveredOrders']);

    });

});

