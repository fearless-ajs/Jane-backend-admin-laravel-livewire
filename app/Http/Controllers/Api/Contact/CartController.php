<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\ApiController;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\CompanyCatalogue;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiController
{
    public function addCatalogueToCart($catalogue_id){
        $catalogue = CompanyCatalogue::findOrFail($catalogue_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        if ($catalogue->type == 'product'){
            if(!$cart){
                // Create cart
                $cart = Cart::create([
                    'user_id'        => auth()->user()->id,
                    'checkout'       => false,
                    'total_price'    => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);

                // Check if the product quantity is available
                if ($catalogue->quantity < 1){
                    return $this->errorResponse([
                        'errorCode' => 'CART_ERROR',
                        'message'   => 'The product does not have enough quantity'
                    ], 422);
                }

                // Create cart product
                CartProduct::create([
                    'cart_id'               => $cart->id,
                    'catalogue_id'          => $catalogue_id,
                    'quantity'              => 1,
                    'total_product_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);
            }else{
                // If cart already exist
                $cartProduct = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
                if ($cartProduct){
                    // Update the cart product
                    $cartProduct->update([
                        'quantity'             => $cartProduct->quantity + 1,
                        'total_product_price' =>  $catalogue->price *($cartProduct->quantity + 1),
                    ]);
                    // Update the cart total price
                    if ($catalogue->tax){
                        $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price) * ($cartProduct->quantity + 1);
                    }else{
                        $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ($catalogue->price * ($cartProduct->quantity + 1));
                    }
                    $cart->save();
                }else{
                    CartProduct::create([
                        'cart_id'               => $cart->id,
                        'catalogue_id'          => $catalogue_id,
                        'quantity'              => 1,
                        'total_product_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                    ]);
                    if ($catalogue->tax){
                        $cart->total_price  = $cart->total_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                    }else{
                        $cart->total_price  = $cart->total_price + $catalogue->price;;
                    }
                    $cart->save();
                }
            }

            $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products.catalogue.tax')->with(['services.catalogue.cycle', 'services.catalogue.tax'])->first();
            return $this->successResponse($new_cart, 200);

        }else if ($catalogue->type == 'service'){
            if(!$cart){
                // Create cart
                $cart = Cart::create([
                    'user_id'        => auth()->user()->id,
                    'checkout'       => false,
                    'total_price'    => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);
                // Create cart product
                CartService::create([
                    'cart_id'               => $cart->id,
                    'catalogue_id'          => $catalogue_id,
                    'total_service_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                ]);
            }else{
                // If cart already exist
                $cartService = CartService::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
                if ($cartService){
                    // Update the cart product
//                    $cartService->update([
//                        'volume'              => $cartService->volume + 1,
//                        'total_service_price' =>  $catalogue->price *($cartService->volume + 1),
//                    ]);
//                    // Update the cart total price
//                    $cart->total_price  = ($cart->total_price - $cartService->total_service_price) + ($service->price * ($cartService->volume + 1));
                    $cart->save();
                }else{
                    CartService::create([
                        'cart_id'               => $cart->id,
                        'catalogue_id'          => $catalogue_id,
                        'total_service_price'   => ($catalogue->tax)?(($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price : $catalogue->price
                    ]);

                    if ($catalogue->tax){
                        $cart->total_price  = $cart->total_price + ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
                    }else{
                        $cart->total_price  = $cart->total_price + $catalogue->price;
                    }

                    $cart->save();
                }
            }

            $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products.catalogue.tax')->with(['services.catalogue.cycle', 'services.catalogue.tax'])->first();
            return $this->successResponse($new_cart, 200);
        }
    }

    public function removeCatalogueFromCart($catalogue_id){
        $catalogue = CompanyCatalogue::findOrFail($catalogue_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        if ($catalogue->type == 'product'){
            // Check if the user has a cart
            if (!$cart){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'Please select at least one product or service'
                ], 422);
            }
            // find the product in user cart
            $cartProduct = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
            // check if the product exist in user cart
            if (!$cartProduct){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'This product is not in your cart'
                ], 422);
            }

            // Check if the quantity is equal to 1, then delete the record from cart
            if ($cartProduct->quantity <= 1){
                // remove the product from cart
                $cartProduct->delete();

                // Update the cart total price
                $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price);
                $cart->save();
            }else{
                if ($catalogue->tax){
                    //Update the cart product
                    $cartProduct->update([
                        'quantity'             => $cartProduct->quantity - 1,
                        'total_product_price' =>  $cartProduct->total_product_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price)
                    ]);
                    // Update the cart total price
                    $cart->total_price  =  $cart->total_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);;
                }else{
                    //Update the cart product
                    $cartProduct->update([
                        'quantity'             => $cartProduct->quantity - 1,
                        'total_product_price' =>  $cartProduct->total_product_price -  $catalogue->price
                    ]);
                    // Update the cart total price
                    $cart->total_price  =  $cart->total_price -  $catalogue->price;
                }
                $cart->save();
            }

        }else if ($catalogue->type = 'service'){
            // Check if the user has a cart
            if (!$cart){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'Please select at least one product or service'
                ], 422);
            }

            // find the product in user cart
            $cartService = CartService::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
            // check if the product exist in user cart
            if (!$cartService){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'This service is not in your cart'
                ], 422);
            }

            // Update the cart total price
            if ($catalogue->tax){
                $cart->total_price  = $cart->total_price - ((($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price);
            }else{
                $cart->total_price  = $cart->total_price - $catalogue->price;
            }

            $cartService->delete();
            $cart->save();
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products.catalogue.tax')->with(['services.catalogue.cycle', 'services.catalogue.tax'])->first();
        return $this->successResponse($new_cart, 200);
    }

    public function cancelCatalogueFromCart($catalogue_id){
        $catalogue = CompanyCatalogue::find($catalogue_id);
        if (!$catalogue){
            return $this->errorResponse([
                'errorCode' => 'CATALOGUE_ERROR',
                'message'   => 'Catalogue not available'
            ], 422);
        }
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        // Check if the user has a cart
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'You do not have am active cart'
            ], 422);
        }


        if ($catalogue->type == 'product'){
            // find the product in user cart
            $cartProduct = CartProduct::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
            // check if the product exist in user cart
            if (!$cartProduct){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'This product is not in your cart'
                ], 422);
            }


            // remove the product from cart
            $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price);
            $cartProduct->delete();
            $cart->save();

        }

        if ($catalogue->type == 'service'){
            // find the product in user cart
            $cartService = CartService::where('cart_id', $cart->id)->where('catalogue_id', $catalogue_id)->first();
            // check if the product exist in user cart
            if (!$cartService){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'This service is not in your cart'
                ], 422);
            }

            $cart->total_price  = ($cart->total_price - $cartService->total_service_price);
            $cartService->delete();
            $cart->save();
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products.catalogue.tax')->with(['services.catalogue.cycle', 'services.catalogue.tax'])->first();
        return $this->successResponse($new_cart, 200);

    }


    public function fetchUserCart(){
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'EMPTY_CART',
                'message'   => 'Your cart is empty'
            ], 422);
        }
        return $this->successResponse($cart, 200);
    }

    public function clearCart(){
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        // Check if the user has a cart
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'Please select at least one product or service'
            ], 422);
        }

        // Remove all products
        CartProduct::where('cart_id', $cart->id)->delete();
        // Remove all services
        CartService::where('cart_id', $cart->id)->delete();
        // Reset cart total price to zero
        $cart->total_price  = 0;
        $cart->save();
        return $this->successResponse([
            'errorCode'     =>  'SUCCESS',
            'message'       => 'Cart cleared'
        ], 200);
    }

}
