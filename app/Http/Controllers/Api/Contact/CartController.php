<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Api\ApiController;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiController
{
    public function addProductToCart($product_id){
        $product = Product::findOrFail($product_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
        if(!$cart){
            // Create cart
            $cart = Cart::create([
               'user_id'        => auth()->user()->id,
               'checkout'       => false,
               'total_price'    => $product->price
            ]);

            // Check if the product quantity is available
            if ($product->quantity < 1){
                return $this->errorResponse([
                    'errorCode' => 'CART_ERROR',
                    'message'   => 'The product does not have enough quantity'
                ], 422);
            }

            // Create cart product
            CartProduct::create([
                'cart_id'               => $cart->id,
                'product_id'            => $product_id,
                'quantity'              => 1,
                'total_product_price'   => $product->price
            ]);
        }else{
            // If cart already exist
            $cartProduct = CartProduct::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
            if ($cartProduct){
                // Update the cart product
                $cartProduct->update([
                    'quantity'             => $cartProduct->quantity + 1,
                    'total_product_price' =>  $product->price *($cartProduct->quantity + 1),
                ]);
                // Update the cart total price
                $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ($product->price * ($cartProduct->quantity + 1));
                $cart->save();
            }else{
                CartProduct::create([
                    'cart_id'               => $cart->id,
                    'product_id'            => $product_id,
                    'quantity'              => 1,
                    'total_product_price'   => $product->price
                ]);
                $cart->total_price  = $cart->total_price + $product->price;
                $cart->save();
            }
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
        return $this->successResponse($new_cart, 200);
    }

    public function addServiceToCart($service_id){
        $service = Service::findOrFail($service_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();
        if(!$cart){
            // Create cart
            $cart = Cart::create([
                'user_id'        => auth()->user()->id,
                'checkout'       => false,
                'total_price'    => $service->price
            ]);
            // Create cart product
            CartService::create([
                'cart_id'               => $cart->id,
                'service_id'            => $service_id,
                'rate'                  => $service->usage_unit,
                'volume'                => 1,
                'total_service_price'   => $service->price
            ]);
        }else{
            // If cart already exist
            $cartService = CartService::where('cart_id', $cart->id)->where('service_id', $service_id)->first();
            if ($cartService){
                // Update the cart product
                $cartService->update([
                    'volume'              => $cartService->volume + 1,
                    'total_service_price' =>  $service->price *($cartService->volume + 1),
                ]);
                // Update the cart total price
                $cart->total_price  = ($cart->total_price - $cartService->total_service_price) + ($service->price * ($cartService->volume + 1));
                $cart->save();
            }else{
                CartService::create([
                    'cart_id'               => $cart->id,
                    'service_id'            => $service_id,
                    'rate'                  => $service->usage_unit,
                    'volume'                => 1,
                    'total_service_price'   => $service->price
                ]);
                $cart->total_price  = $cart->total_price + $service->price;
                $cart->save();
            }
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
        return $this->successResponse($new_cart, 200);
    }

    public function removeProductFromCart($product_id){
        $product = Product::findOrFail($product_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        // Check if the user has a cart
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'Please select at least one product or service'
            ], 422);
        }
        // find the product in user cart
        $cartProduct = CartProduct::where('cart_id', $cart->id)->where('product_id', $product_id)->first();
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
            //Update the cart product
            $cartProduct->update([
                'quantity'             => $cartProduct->quantity - 1,
                'total_product_price' =>  $product->price * ($cartProduct->quantity - 1),
            ]);
            // Update the cart total price
            $cart->total_price  = ($cart->total_price - $cartProduct->total_product_price) + ($product->price * ($cartProduct->quantity - 1));
            $cart->save();
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
        return $this->successResponse($new_cart, 200);
    }

    public function removeServiceFromCart($service_id){
        $service = Service::findOrFail($service_id);
        // If cart doesn't exist
        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->first();

        // Check if the user has a cart
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'Please select at least one product or service'
            ], 422);
        }

        // find the product in user cart
        $cartService = CartService::where('cart_id', $cart->id)->where('service_id', $service_id)->first();
        // check if the product exist in user cart
        if (!$cartService){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'This service is not in your cart'
            ], 422);
        }

        // Check if the quantity is equal to 1, then delete the record from cart
        if ($cartService->volume <= 1){
            // remove the product from cart
            $cartService->delete();

            // Update the cart total price
            $cart->total_price  = ($cart->total_price - $cartService->total_service_price);
            $cart->save();
        }else{
            $cartService->update([
                'volume'              => $cartService->volume - 1,
                'total_service_price' =>  $service->price *($cartService->volume - 1),
            ]);
            // Update the cart total price
            $cart->total_price  = ($cart->total_price - $cartService->total_service_price) + ($service->price * ($cartService->volume - 1));
            $cart->save();
        }

        $new_cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
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
