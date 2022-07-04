<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\CartService;
use App\Models\ContactBillingAddress;
use App\Models\ContactPaymentMethod;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderService;
use Illuminate\Http\Request;
use LVR\CreditCard\CardNumber;

class OrderController extends Controller
{
    public function checkout(Request $request){
        $request->validate([
            'address'    => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'state'      => 'required|string|max:255',
            'city'       => 'required|string|max:255',
        ]);

        $cart = Cart::where('user_id', auth()->user()->id)->where('checkout', false)->with('products')->with('services')->first();
        // Check if the user has a cart
        if (!$cart){
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'Please select at least one catalog'
            ], 422);
        }

        if (count($cart->products) < 1 && count($cart->services) < 1){
            // Check if the cart is empty
            return $this->errorResponse([
                'errorCode' => 'CART_ERROR',
                'message'   => 'Please select at least one product or service'
            ], 422);
        }

        $order = Order::create([
            'user_id'       => auth()->user()->id,
            'total_paid'    => $cart->total_price,
            'total_price'   => $cart->total_price,
            'status'        => 'placed',
            'address'       => $request->address,
            'country'       => $request->country,
            'state'         => $request->state,
            'city'          => $request->city,
        ]);

        if (count($cart->products) > 0){
            foreach ($cart->products as $product){
                OrderProduct::create([
                    'order_id'            =>  $order->id,
                    'product_id'          => $product->product_id,
                    'quantity'            => $product->quantity,
                    'total_product_price' => $product->total_product_price
                ]);
            }
        }

        if (count($cart->services) > 0){
            foreach ($cart->services as $service){
                OrderService::create([
                    'order_id'            => $order->id,
                    'service_id'          => $service->service_id,
                    'rate'                => $service->rate,
                    'volume'              => $service->volume,
                    'total_service_price' => $service->total_service_price
                ]);
            }
        }

        // Set checkout to true
        $cart->checkout = true;
        $cart->save();

        // Clear cart
        $this->clearCart($cart);

        // fetch the new order details
        $new_order  = Order::where('id', $order->id)->with('products')->with('services')->first();

        return $this->successResponse([
            'errorCode'     => 'SUCCESS',
            'message'       => 'order placed',
            'data'          => $new_order,
        ], 200);

    }

    public function clearCart($cart){
        // Remove all products
        CartProduct::where('cart_id', $cart->id)->delete();
        // Remove all services
        CartService::where('cart_id', $cart->id)->delete();
        // Reset cart total price to zero
        $cart->total_price  = 0;
        $cart->save();
    }

    public function fetchMyOrders(){
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->with('products')
            ->with('services')
            ->get();
        return $this->showAll($orders, 200);
    }

    public function fetchMyInProgressOrders(){
        $orders = Order::where('user_id', auth()->user()->id)
            ->where('status', 'in_progress')
            ->orderBy('created_at', 'DESC')
            ->with('products')
            ->with('services')
            ->get();
        return $this->showAll($orders, 200);
    }

    public function fetchMyDeliveredOrders(){
        $orders = Order::where('user_id', auth()->user()->id)
            ->where('status', 'delivered')
            ->orderBy('created_at', 'DESC')
            ->with('products')
            ->with('services')
            ->get();
        return $this->showAll($orders, 200);
    }

    public function getMyBillingInformation(){
        $billingAddress = ContactBillingAddress::where('user_id', auth()->user()->id)->first();
        return $this->showOne($billingAddress);
    }

    public function updateMyBillingInformation(Request $request){
        $request->validate([
            'fullname'       =>  'nullable|string|max:255',
            'phone'          =>  'nullable|numeric',
            'email'          =>  'nullable|email|max:255',
            'vat'            =>  'nullable|string|max:255',
            'tax_id'         =>  'nullable|string|max:255',
            'city'           =>  'nullable|string|max:255',
            'state'          =>  'nullable|string|max:255',
            'country'        =>  'nullable|string|max:255',
            'address'        =>  'nullable|string|max:255',
            'zip'            =>  'nullable|string|max:255'
        ]);

        $billingAddress = ContactBillingAddress::where('user_id', auth()->user()->id)->first();

        $billingAddress->fill($request->only([
            'fullname',
            'phone',
            'email',
            'vat',
            'tax_id',
            'city',
            'state',
            'country',
            'address',
            'zip'
        ]));

        $billingAddress->save();

        return $this->showOne($billingAddress);
    }

    public function getMyPaymentMethod(){
        $paymentMethod = ContactPaymentMethod::where('user_id', auth()->user()->id)->first();
        return $this->showOne($paymentMethod);
    }

    public function updateMyPaymentMethod(Request $request){
        $request->validate([
            'card_number'    =>  ['nullable', new CardNumber],
            'name'           =>  'nullable|string|max:255',
            'exp'            =>  'nullable|string',
            'cvv'            =>  'nullable|numeric'
        ]);

        $paymentMethod = ContactPaymentMethod::where('user_id', auth()->user()->id)->first();

        $paymentMethod->fill($request->only([
            'card_number',
            'name',
            'exp',
            'cvv'
        ]));

        $paymentMethod->save();

        return $this->showOne($paymentMethod);
    }

}
