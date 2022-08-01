<div>
    <div class="content-detached content-right">
        <div class="content-body">


            <!-- E-commerce Content Section Starts -->
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">
                                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-bs-toggle="collapse">
                                    <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                </button>
                                <div class="search-results">
                                    <h6 wire:loading.remove class="filter-heading"> {{count($orders)}} Orders</h6>
                                    <h6 wire:loading  class="filter-heading">Processing... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h6>
                                </div>

                            </div>
                            <div class="view-options d-flex">
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                                    <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn" for="radio_option1"><i  class="font-medium-3 fa fa-solid fa-th"></i></label>
                                    <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                                    <label class="btn btn-icon btn-outline-primary view-btn list-view-btn" for="radio_option2"><i class="font-medium-3 fa fa-solid fa-bars"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Content Section Starts -->

            <!-- background Overlay when sidebar is shown  starts-->
            <div class="body-content-overlay"></div>
            <!-- background Overlay when sidebar is shown  ends-->

            <!-- E-commerce Search Bar Starts -->
        {{--            <section id="ecommerce-searchbar" class="ecommerce-searchbar">--}}
        {{--                <div class="row mt-1">--}}
        {{--                    <div class="col-sm-12">--}}
        {{--                        <div class="input-group input-group-merge">--}}
        {{--                            <input type="text" wire:model="search" class="form-control search-product" id="shop-search" placeholder="Search for catalogue by name" aria-label="Search..." aria-describedby="shop-search" />--}}
        {{--                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </section>--}}
        <!-- E-commerce Search Bar Ends -->

            <!-- E-commerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">

                @if($orders && count($orders) > 0)
                    @foreach($orders as $item)
                        <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="{{route('company.invoice-order-details', $item->id)}}">
                                    <img class="img-fluid card-img-top" src="{{$item->catalogue->images->first()->Picture}}" alt="img-placeholder" /></a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">

                                            @if($item->catalogue->type === 'product')
                                                <span class="badge badge-light-success">Quantity ordered: {{$item->quantity}} </span>
                                            @endif
                                            @if($item->catalogue->type === 'service')
                                                @if($item->catalogue->cycle)
                                                    <span class="badge badge-light-success">Billing: {{$item->catalogue->cycle->title}} </span>
                                                @else
                                                    <span class="badge badge-light-danger">Billing: Not available </span>
                                                @endif
                                            @endif

                                        </ul>
                                    </div>
                                    <div>
                                        <h6 class="item-price">{{$settings->currency->currency_symbol}}{{$item->total_price}}</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="{{route('company.catalogue-details', $item->catalogue->id)}}">{{$item->catalogue->name}}</a>
                                    <span class="card-text item-company">By <a href="#" class="company-name">{{$item->catalogue->manufacturer}}</a></span>
                                </h6>

                                @if($item->type == 'product')
                                <div class="mt-1">
                                        @if($item->pipeline == 'order_placed')
                                            <span class="badge badge-light-warning">Pipeline status: Waiting confirmation </span>
                                        @endif

                                        @if($item->pipeline == 'order_in_progress')
                                            <span class="badge badge-light-info">Pipeline status: Waiting shipping </span>
                                        @endif

                                        @if($item->pipeline == 'shipped')
                                            <span class="badge badge-light-primary">Pipeline status: Shipped </span>
                                        @endif

                                        @if($item->pipeline == 'out_for_delivery')
                                            <span class="badge badge-light-primary">Pipeline status: Out for delivery </span>
                                        @endif

                                        @if($item->pipeline == 'delivered')
                                            <span class="badge badge-light-success">Pipeline status: Delivered </span>
                                        @endif

                                        @if($item->pipeline == 'cancelled')
                                            <span class="badge badge-light-danger">Pipeline status: Cancelled </span>
                                        @endif
                                </div>
                                @endif
                                @if($item->type == 'service')
                                    <div class="mt-1">
                                        @if($item->pipeline == 'cancelled')
                                            <span class="badge badge-light-danger">Pipeline status: Cancelled </span>
                                        @else
                                            <span class="badge badge-light-success">Pipeline status: Active </span>
                                        @endif
                                    </div>
                                @endif
{{--                                <p class="card-text item-description">--}}
{{--                                    Ordered By:  {{$item->cartOrder->user->firstname}} {{$item->cartOrder->user->lastname}}--}}
{{--                                </p>--}}
                            </div>
                            <div class="item-options text-center">
                                <div class="item-wrapper">
                                    <div class="item-cost">
                                        <h4 class="item-price">{{$settings->currency->currency_symbol}} {{$item->total_price}}</h4>
                                    </div>
                                </div>
                                @if($item->pipeline == 'cancelled')
                                    <a href="#" wire:click="resume({{$item->id}})" class="btn btn-outline-success btn-wishlist">
                                        <span wire:loading wire:target="resume({{$item->id}})"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <i wire:loading.remove wire:target="resume({{$item->id}})"  class="fa fa-cart-arrow-down"></i>
                                        <span>Resume order</span>
                                    </a>
                                @else
                                    <a href="#" wire:click="cancel({{$item->id}})" class="btn btn-outline-danger btn-wishlist">
                                        <span wire:loading wire:target="cancel({{$item->id}})"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <i wire:loading.remove wire:target="cancel({{$item->id}})"  class="fa fa-cart-arrow-down"></i>
                                        <span>Cancel order</span>
                                    </a>
                                @endif
                                <a href="{{route('company.invoice-order-details', $item->id)}}" class="btn btn-primary">
                                    <span>Track</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif

            </section>
            <!-- E-commerce Products Ends -->


        </div>
    </div>



</div>
