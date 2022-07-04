<div class="content-body">
    <div class="bs-stepper checkout-tab-steps">

        <div class="bs-stepper-content">
            <!-- Checkout Place order starts -->
            <div id="step-cart" class="content" role="tabpanel" aria-labelledby="step-cart-trigger">
                <div id="place-order" class="list-view product-checkout">
                    <div class="checkout-items">
                        @if($cart)
                            @if(count($cart->products) > 0)
                                @foreach($cart->products as $cartItem)
                                    @if($cartItem->catalogue)


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
                                                @if($cartItem->catalogue->quantity < 1)
                                                    <span class="text-danger mb-1">Out Of Stock</span>
                                                @else
                                                    @if($cartItem->catalogue->quantity < $cartItem->quantity)
                                                        <span class="text-danger mb-1">Quantity above available product</span>
                                                    @else
                                                        <span class="text-success mb-1">In Stock</span>
                                                    @endif
                                                @endif

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
                                                    <span class="badge badge-light-primary" style="cursor:pointer;"  wire:click="removeItem({{$cartItem->catalogue->id}})">-</span>
                                                    <span class="badge badge-light-primary" style="cursor:pointer;" wire:click="addItem({{$cartItem->catalogue->id}})">+</span>
                                                </div>

                                            </div>
                                            <div class="item-options text-center">
                                                <div class="item-wrapper">
                                                    <div class="item-cost">
                                                        <h4 class="item-price">{{$settings->currency->currency_symbol}}{{$cartItem->catalogue->price * $cartItem->quantity}}</h4>
                                                        {{--                                                    <p class="card-text shipping">--}}
                                                        {{--                                                        <span class="badge rounded-pill badge-light-success">Free Shipping</span>--}}
                                                        {{--                                                    </p>--}}
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-light mt-1 remove-wishlist"  wire:click="removeCatalogue({{$cartItem->catalogue->id}})">
                                                    <i class="align-middle me-25 fa fa-window-close"></i>
                                                    <span>Remove</span>
                                                </button>
                                            </div>
                                        </div>

                                    @else
                                        <p class="text text-danger">Product not available</p>
                                    @endif
                                @endforeach
                            @endif
                        @endif


                        @if($cart)
                            @if(count($cart->services) > 0)
                                @foreach($cart->services as $cartItem)
                                    @if($cartItem->catalogue)
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
                                                        <h4 class="item-price">{{$settings->currency->currency_symbol}}{{$cartItem->catalogue->price}}</h4>
                                                        {{--                                                    <p class="card-text shipping">--}}
                                                        {{--                                                        <span class="badge rounded-pill badge-light-success">Free Shipping</span>--}}
                                                        {{--                                                    </p>--}}
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-light mt-1 remove-wishlist"  wire:click="removeCatalogue({{$cartItem->catalogue->id}})">
                                                    <i class="align-middle me-25 fa fa-window-close"></i>
                                                    <span>Remove</span>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text text-danger">Service not available</p>
                                    @endif
                                @endforeach
                            @endif
                        @endif

                    </div>


                    <!-- Checkout Place Order Right starts -->
                    <div class="checkout-options">
                        <div class="card">
                            <div class="card-body">
{{--                                <label class="section-label form-label mb-1">Options</label>--}}
{{--                                <div class="coupons input-group input-group-merge">--}}
{{--                                    <input type="text" class="form-control" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />--}}
{{--                                    <span class="input-group-text text-primary ps-1" id="input-coupons">Apply</span>--}}
{{--                                </div>--}}
{{--                                <hr />--}}
                                <div class="price-details">
                                    <h6 class="price-title">Price Details</h6>
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title">Estimated Price</div>
                                            <div class="detail-amt">{{$settings->currency->currency_symbol}}{{$totalPrice}}</div>
                                        </li>
{{--                                        <li class="price-detail">--}}
{{--                                            <div class="detail-title">Bag Discount</div>--}}
{{--                                            <div class="detail-amt discount-amt text-success">-25$</div>--}}
{{--                                        </li>--}}
                                        <li class="price-detail">
                                            <div class="detail-title">Estimated Tax</div>
                                            <div class="detail-amt">{{$settings->currency->currency_symbol}}{{$totalTax}}</div>
                                        </li>
{{--                                        <li class="price-detail">--}}
{{--                                            <div class="detail-title">EMI Eligibility</div>--}}
{{--                                            <a href="#" class="detail-amt text-primary">Details</a>--}}
{{--                                        </li>--}}
{{--                                        <li class="price-detail">--}}
{{--                                            <div class="detail-title">Delivery Charges</div>--}}
{{--                                            <div class="detail-amt discount-amt text-success">Free</div>--}}
{{--                                        </li>--}}
                                    </ul>
                                    <hr />
                                    <ul class="list-unstyled">
                                        <li class="price-detail">
                                            <div class="detail-title detail-total">Total Price</div>
                                            <div class="detail-amt fw-bolder">{{$settings->currency->currency_symbol}}{{$totalPriceWithTax}}</div>
                                        </li>
                                    </ul>
                                    <a href="{{route('contact.checkout')}}" type="button" class="btn btn-primary w-100 btn-next place-order">Place Order</a>
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Place Order Right ends -->
                    </div>
                </div>
                <!-- Checkout Place order Ends -->
            </div>
            <!-- </div> -->
        </div>
    </div>

</div>
