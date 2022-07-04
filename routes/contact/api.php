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
use App\Http\Controllers\Api\Contact\CatalogueController;
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


//    Route::resource('products',                     ProductController::class, ['only' => ['index', 'show']]);
//    Route::resource('services',                     ServiceController::class, ['only' => ['index', 'show']]);

    Route::get('catalog',                                     [CatalogueController::class, 'index']);
    Route::get('/catalog/{id}',                               [CatalogueController::class, 'show']);


    Route::get('/categories',                                 [ProductCategoryController::class, 'categories']);
    Route::get('/company/{company_id}/categories',            [ProductCategoryController::class, 'companyCategories']);
    Route::get('/category/{category_name}/products',          [ProductCategoryController::class, 'categoryProducts']);


    // Protection routes for signed in users only
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/cart/add-catalogue/{catalogue_id}',                             [CartController::class, 'addCatalogueToCart']);
        Route::post('/cart/remove-catalogue/{catalogue_id}',                          [CartController::class, 'removeCatalogueFromCart']);
        Route::post('/cart/cancel-catalogue/{catalogue_id}',                          [CartController::class, 'cancelCatalogueFromCart']);

        Route::get('/cart/my-cart',                                                   [CartController::class, 'fetchUserCart']);
        Route::post('/cart/clear',                                                    [CartController::class, 'clearCart']);

        Route::post('/cart/checkout',                                                 [OrderController::class, 'checkout']);
        Route::get('/order/fetch/all-my-orders',                                      [OrderController::class, 'fetchMyOrders']);
        Route::get('/order/fetch/all-my-in-progress-orders',                          [OrderController::class, 'fetchMyInProgressOrders']);
        Route::get('/order/fetch/all-my-delivered-orders',                            [OrderController::class, 'fetchMyDeliveredOrders']);


        Route::get('/payment/billing-address',                                           [OrderController::class, 'getMyBillingInformation']);
        Route::patch('/payment/billing-address',                                         [OrderController::class, 'updateMyBillingInformation']);
        Route::get('/payment/payment-method',                                            [OrderController::class, 'getMyPaymentMethod']);
        Route::patch('/payment/payment-method',                                          [OrderController::class, 'updateMyPaymentMethod']);

    });

});

