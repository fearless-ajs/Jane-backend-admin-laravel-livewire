<div class="content-body">
    <!-- app e-commerce details start -->
    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{$item->catalogue->images->first()->picture}}" class="img-fluid product-img" alt="product image" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4>{{$item->catalogue->name}}</h4>
                        @if($item->catalogue->type === 'product')
                            <span class="card-text item-company">By <a href="#" class="company-name">{{$item->catalogue->manufacturer}}</a></span>
                        @endif
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">

                            <h4 class="item-price me-1">{{$settings->currency->currency_symbol}}{{$item->total_price}}</h4>

                            @if($item->catalogue->category)
                                <ul class="unstyled-list list-inline ps-1 border-start">
                                    <span class="badge badge-light-success">Category: {{$item->catalogue->category}} </span>
                                </ul>
                            @endif
                        </div>

{{--                        @if($item->catalogue->type === 'product')--}}
{{--                            @if($catalogue->quantity > 0)--}}
{{--                                <p class="card-text">Available - <span class="text-success">In stock</span></p>--}}
{{--                            @else--}}
{{--                                <p class="card-text">Not Available - <span class="text-success">Out of stock</span></p>--}}
{{--                            @endif--}}
{{--                        @endif--}}
                        @if($item->catalogue->type === 'service')
                            @if($item->catalogue->cycle)
                                <p class="card-text">Billing - <span class="text-success">{{$item->catalogue->cycle->title}}</span></p>
                            @else
                                <p class="card-text">Billing - <span class="text-danger">Not available</span></p>
                            @endif
                        @endif


                        <p class="card-text">
                            {{$item->catalogue->description}}
                        </p>
                        <ul class="product-features list-unstyled">
                            @if($item->catalogue->type === 'product')
                                <li>
                                    <i>Brand:</i>
                                    <span>{{$item->catalogue->brand}}</span>
                                </li>
                            @endif
                        </ul>
                        <hr />
                        @if($item->catalogue->type === 'product')
                            <div class="product-color-options">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-inline-block selected">
                                        <div class="color-option b-primary">
                                            <div class="filloption bg-primary"></div>
                                        </div>
                                    </li>
                                </ul>
                                <p class="card-text">Ordered By: <span> {{$item->cartOrder->user->firstname}} {{$item->cartOrder->user->lastname}}</span></p>
                                <p class="card-text">Ordered quantity - <span class="text-success">{{$item->quantity}}</span></p>
                                <p class="card-text">
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
                                </p>

                            </div>
                            <hr />
                        @endif

                        <div class="product-color-options mb-2">
                            @if($item->type === 'service')
                                @if($item->pipeline == 'cancelled' || $item->terminated == true)
                                    <span class="badge badge-light-danger">Service status: Cancelled </span>
                                @else
                                    <span class="badge badge-light-success">Service status: Active </span>
                                @endif
                            @endif
                        </div>


                        <div class="mb-2">
                            <span wire:loading class="badge badge-light-success">
                                <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                            </span>
                        </div>



                    @if($item->catalogue->type === 'product')
                            <div class="d-flex flex-column flex-sm-row pt-1">
                                @if($item->pipeline != 'delivered')
                                    @if($item->pipeline == 'cancelled')
                                        <button type="button" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0" wire:click="resume({{$item->id}})">
                                            Resume order
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger me-0 me-sm-1 mb-1 mb-sm-0" wire:click="cancel({{$item->id}})">
                                            Cancel order
                                        </button>
                                    @endif
                                @endif

                                @if($item->pipeline == 'order_placed')
                                    <button type="button" wire:loading.remove wire:target="confirmOrder"  wire:click="confirmOrder" class="btn btn-outline-warning me-0 me-sm-1 mb-1 mb-sm-0">
                                        Confirm item
                                    </button>
                                    <button type="button" wire:loading wire:target="confirmOrder" disabled class="btn btn-outline-warning me-0 me-sm-1 mb-1 mb-sm-0">
                                        <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                                    </button>
                                @endif

                                @if($item->pipeline == 'order_in_progress')
                                    <button type="button" wire:loading.remove wire:target="shipOrder"  wire:click="shipOrder" class="btn btn-outline-info me-0 me-sm-1 mb-1 mb-sm-0">
                                        Ship item
                                    </button>
                                    <button type="button" wire:loading wire:target="shipOrder" disabled class="btn btn-outline-info me-0 me-sm-1 mb-1 mb-sm-0">
                                        <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                                    </button>
                                @endif

                                @if($item->pipeline == 'shipped')
                                    <button type="button" wire:loading.remove wire:target="moveOrderForDelivery"  wire:click="moveOrderForDelivery" class="btn btn-outline-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                        Move item for delivery
                                    </button>
                                    <button type="button" wire:loading wire:target="moveOrderForDelivery" disabled class="btn btn-outline-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                        <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                                    </button>
                                @endif

                                @if($item->pipeline == 'out_for_delivery')
                                    <button type="button" wire:loading.remove wire:target="orderDelivered"  wire:click="orderDelivered" class="btn btn-outline-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                        Confirm item delivery
                                    </button>
                                    <button type="button" wire:loading wire:target="orderDelivered" disabled class="btn btn-outline-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                        <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                                    </button>
                                @endif

                                @if($item->pipeline == 'delivered')
                                    <button type="button" class="btn btn-outline-success me-0 me-sm-1 mb-1 mb-sm-0" disabled>
                                        Item delivered
                                    </button>
                                @endif




                            </div>
                        @endif

                        @if($item->catalogue->type === 'service')
                            @if($item->pipeline == 'cancelled')
                                <button type="button" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0" wire:click="resumeService">
                                    Resume service
                                </button>
                            @else
                                <button type="button" class="btn btn-danger me-0 me-sm-1 mb-1 mb-sm-0" wire:click="cancelService">
                                    Cancel service
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- Product Details ends -->
        </div>



    </section>
    <!-- app e-commerce details end -->

    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row">
                    <h4 class="justify-content-center" style="text-align: center;">{{ucwords($item->catalogue->type)}} images
                        <span wire:loading wire:target="removeImage"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>
                    @if(count($item->catalogue->images) > 0)
                        @foreach($item->catalogue->images as $image)
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{$image->picture}}" class="img-fluid product-img" alt="product image" />
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- Product Details ends -->
        </div>
    </section>

</div>
