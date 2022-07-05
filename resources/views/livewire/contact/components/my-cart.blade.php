<nav wire:ignore.self class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">

        <ul class="nav navbar-nav align-items-center ms-auto" >
            <li class="nav-item dropdown dropdown-cart me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon fa fa-shopping-cart"></i><span class="badge rounded-pill bg-primary badge-up cart-item-count">{{$cartCataloguesTotal}}</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">My Cart</h4>
                            <div class="badge rounded-pill badge-light-primary">
                                {{$cartCataloguesTotal}}

                                @if($cartCataloguesTotal > 1)
                                    Items
                                @else
                                    Item
                                @endif
                            </div>
                        </div>
                    </li>
                    @if($cart)
                        <li class="scrollable-container media-list">

                            @if(count($cart->products) > 0)
                                @foreach($cart->products as $cartItem)
                                    @if($cartItem->catalogue)
                                        <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{$cartItem->catalogue->images->first()->Picture}}" alt="donuts" width="62">
                                            <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                                <div class="media-heading">
                                                    <h6 class="cart-item-title"><a class="text-body" href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}">
                                                            {{$cartItem->catalogue->name}}</a></h6><small class="cart-item-by">By {{$cartItem->catalogue->manufacturer}}</small>
                                                </div>
                                                <div class="cart-item-qty">
                                                    <div class="input-group">
                                                            <span style="cursor:pointer;"  wire:click="removeItem({{$cartItem->catalogue->id}})">
                                                                <small style="font-size: 120%;">-</small>
                                                            </span>
                                                                        <span style="margin-right: 8px; margin-left: 8px;">
                                                                <small  style="font-size: 110%;">{{$cartItem->quantity}}</small>
                                                            </span>
                                                                        <span style="cursor:pointer;" wire:click="addItem({{$cartItem->catalogue->id}})">
                                                                <small  style="font-size: 120%;">+</small>
                                                            </span>
                                                                        {{--                                            <input class="touchspin-cart" wire:model="quantity" type="number" value="{{$cartItem->quantity}}">--}}
                                                    </div>
                                                </div>
                                                <h5 class="cart-item-price">{{$settings->currency->currency_symbol}}{{$cartItem->total_product_price}}</h5>
                                            </div>
                                            @else
                                                <p class="text text-danger">Item not Available</p>
                                            @endif
                                        </div>
                                        @endforeach
                                    @endif



                            @if(count($cart->services) > 0)
                                                    @foreach($cart->services as $cartItem)
                                                        @if($cartItem->catalogue)
                                                            <div class="list-item align-items-center"><img class="d-block rounded me-1" src="{{$cartItem->catalogue->images->first()->Picture}}" alt="donuts" width="62">
                                                                <div class="list-item-body flex-grow-1"><i class="ficon cart-item-remove" data-feather="x"></i>
                                                                    <div class="media-heading">
                                                                        <h6 class="cart-item-title"><a class="text-body" href="{{route('contact.catalogue-details', $cartItem->catalogue->id)}}">

                                                                                {{$cartItem->catalogue->name}}</a></h6>
                                                                        @if($cartItem->catalogue->cycle)
                                                                            <small class="cart-item-by">Billing: {{$cartItem->catalogue->cycle->title}}
                                                                                @else
                                                                              <small class="cart-item-by">Billing: <span class="text text-danger">Not available</span> </small>
                                                                        @endif
                                                                    </div>
                                                                    <div class="cart-item-qty">
                                                                        <div class="input-group">
                                                                            <span style="cursor:pointer; margin-left: 20px;" wire:click="removeService({{$cartItem->catalogue->id}})">
                                                                                  <small  style="font-size: 120%;" class="text text-danger">X</small>
                                                                            </span>
                                                                            {{--                                            <input class="touchspin-cart" wire:model="quantity" type="number" value="{{$cartItem->quantity}}">--}}
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="cart-item-price">{{$settings->currency->currency_symbol}}{{$cartItem->total_service_price}}</h5>
                                                                </div>
                                                                @else
                                                                    <p class="text text-danger">Item not Available</p>
                                                                @endif
                                                            </div>
                                            @endforeach
                                        @endif
                        </li>
                    @endif
                    <li class="dropdown-menu-footer">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="fw-bolder mb-0">Total:</h6>
                            <h6 class="text-primary fw-bolder mb-0">{{$settings->currency->currency_symbol}}{{round($totalPrice, 2)}}</h6>
                        </div><a class="btn btn-primary w-100" href="{{route('contact.cart')}}">Checkout</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{  Auth::user()->lastname . ' ' . Auth::user()->firstname }}</span><span class="user-status">Contact</span></div><span class="avatar"><img class="round" src="{{Auth::user()->UserImage}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('contact.profile')}}"><i class="me-50" data-feather="settings"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('sign-out')}}"><i class="me-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

