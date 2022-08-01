<div class="content-body">
    <div class="bs-stepper checkout-tab-steps">



        <div class="bs-stepper-content">

            <!-- Checkout Place order starts -->
            <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                <div id="place-order" class="list-view product-checkout">

                    <div class="checkout-items">
                        @if(session()->has('message'))
                            <div style="text-align: center; border-radius: 20px; padding: 20px;" class="mb-2 bg-success">
                                <h4 class="">{{session()->get('message')}}</h4>
                            </div>
                        @endif
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                @if(count($order->items) > 0)
                                    @foreach($order->items as $cartItem)
                                        @if($cartItem->type === 'product')
                                        <div class="card ecommerce-card">
                                            <div class="item-img">
                                                <a href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}">
                                                    <img src="{{$cartItem->catalogue->images->first()->Picture}}" alt="img-placeholder" />
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="item-name">
                                                    <h6 class="mb-0"><a href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}" class="text-body"> {{$cartItem->catalogue->name}}</a></h6>
                                                    <span class="item-company">By <a href="#" class="company-name"> {{$cartItem->catalogue->manufacturer}}</a></span>
                                                </div>
{{--                                                @if($cartItem->catalogue->quantity < 1)--}}
{{--                                                    <span class="text-danger mb-1">Out Of Stock</span>--}}
{{--                                                @else--}}
{{--                                                    @if($cartItem->catalogue->quantity < $cartItem->quantity)--}}
{{--                                                        <span class="text-danger mb-1">Quantity above available product</span>--}}
{{--                                                    @else--}}
{{--                                                        <span class="text-success mb-1">In Stock</span>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}

                                                <div class="item-quantity mb-1">
                                                    <span class="quantity-title">Qty: </span>
                                                    <div class="quantity-counter-wrapper">
                                                        <div class="input-group">
                                                            <small>{{$cartItem->quantity}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--                                            <span class="delivery-date text-muted">Delivery by, Wed Apr 25</span>--}}
                                                <div>
                                                    <span class="badge badge-light-primary" style="cursor:pointer;">Ordered on:{{ \Carbon\Carbon::parse($cartItem->created_at)->translatedFormat(' j F Y')}}  </span>
                                                </div>

                                                <div class="mt-1">
                                                    @if($cartItem->pipeline == 'order_placed')
                                                        <span class="badge badge-light-warning">Status: Waiting confirmation </span>
                                                    @endif

                                                    @if($cartItem->pipeline == 'order_in_progress')
                                                        <span class="badge badge-light-info">Status: Waiting shipping </span>
                                                    @endif

                                                    @if($cartItem->pipeline == 'shipped')
                                                        <span class="badge badge-light-primary">Status: Shipped </span>
                                                    @endif

                                                    @if($cartItem->pipeline == 'out_for_delivery')
                                                        <span class="badge badge-light-primary">Status: Out for delivery </span>
                                                    @endif

                                                    @if($cartItem->pipeline == 'delivered')
                                                        <span class="badge badge-light-success">Status: Delivered </span>
                                                    @endif

                                                    @if($cartItem->pipeline == 'cancelled')
                                                        <span class="badge badge-light-danger">Status: Cancelled </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="item-options text-center">
                                                <div class="item-wrapper">
                                                    <div class="item-cost">
                                                        <h4 class="item-price">{{$settings->currency->currency_symbol}}{{$cartItem->total_price}}</h4>
                                                        {{--                                                    <p class="card-text shipping">--}}
                                                        {{--                                                        <span class="badge rounded-pill badge-light-success">Free Shipping</span>--}}
                                                        {{--                                                    </p>--}}
                                                    </div>
                                                </div>

                                                @if($cartItem->pipeline == 'order_placed')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-warning">Waiting confirmation</span>
                                                    </button>
                                                @endif

                                                @if($cartItem->pipeline == 'order_in_progress')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-info">Waiting shipping</span>
                                                    </button>
                                                @endif

                                                @if($cartItem->pipeline == 'shipped')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-primary">Shipped</span>
                                                    </button>
                                                @endif

                                                @if($cartItem->pipeline == 'out_for_delivery')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-primary">Out for delivery</span>
                                                    </button>
                                                @endif

                                                @if($cartItem->pipeline == 'delivered')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-success">Delivered</span>
                                                    </button>
                                                @endif

                                                @if($cartItem->pipeline == 'cancelled')
                                                    <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                        <span class="text text-danger">Cancelled</span>
                                                    </button>
                                                @endif

                                            </div>
                                        </div>
                                        @endif
                                        @if($cartItem->type == 'service')
                                                <div class="card ecommerce-card">
                                                    <div class="item-img">
                                                        <a href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}">
                                                            <img src="{{$cartItem->catalogue->images->first()->Picture}}" alt="img-placeholder" />
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="item-name">
                                                            <h6 class="mb-0"><a href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}" class="text-body"> {{$cartItem->catalogue->name}}</a></h6>
                                                            <span class="item-company">Billing:
                                                            @if($cartItem->catalogue->cycle)
                                                                    <a href="#" class="company-name"> {{$cartItem->catalogue->cycle->title}}</a>
                                                                @else
                                                                    <a href="#" class="company-name text-danger">Billing cycle not available</a>
                                                                @endif
                                                        </span>
                                                        </div>

                                                        <div>
                                                            <span class="badge badge-light-primary" style="cursor:pointer;">Ordered on:{{ \Carbon\Carbon::parse($cartItem->created_at)->translatedFormat(' j F Y')}}  </span>
                                                        </div>

                                                        <div class="mt-1">
                                                            @if($cartItem->pipeline == 'cancelled')
                                                                <span class="badge badge-light-danger">Status: Cancelled </span>
                                                            @else
                                                                <span class="badge badge-light-success">Status: Active </span>
                                                            @endif
                                                        </div>
                                                        {{--                                                <div class="item-quantity mb-1">--}}
                                                        {{--                                                    <span class="quantity-title">Qty: </span>--}}
                                                        {{--                                                    <div class="quantity-counter-wrapper">--}}
                                                        {{--                                                        <div class="input-group">--}}
                                                        {{--                                                            <small>{{$cartItem->quantity}}</small>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                    </div>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                            <span class="delivery-date text-muted">Delivery by, Wed Apr 25</span>--}}
                                                        {{--                                                <div>--}}
                                                        {{--                                                    <span class="badge badge-light-primary" style="cursor:pointer;"  wire:click="removeItem({{$cartItem->catalogue->id}})">-</span>--}}
                                                        {{--                                                    <span class="badge badge-light-primary" style="cursor:pointer;" wire:click="addItem({{$cartItem->catalogue->id}})">+</span>--}}
                                                        {{--                                                </div>--}}

                                                    </div>
                                                    <div class="item-options text-center">
                                                        <div class="item-wrapper">
                                                            <div class="item-cost">
                                                                <h4 class="item-price">{{$settings->currency->currency_symbol}}{{$cartItem->total_price}}</h4>
                                                                {{--                                                    <p class="card-text shipping">--}}
                                                                {{--                                                        <span class="badge rounded-pill badge-light-success">Free Shipping</span>--}}
                                                                {{--                                                    </p>--}}
                                                            </div>
                                                        </div>

                                                       @if($cartItem->pipeline == 'cancelled'))
                                                            <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                                <span class="text text-success">Cancelled</span>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-light mt-1 remove-wishlist" style="cursor: default">
                                                                <span class="text text-success">Active</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif

                    </div>

                </div>
                <!-- Checkout Place order Ends -->
            </div>
            <!-- </div> -->
        </div>
        {{ $orders->links('components.general.pagination-links') /* For pagination links */}}
    </div>

</div>
