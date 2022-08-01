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

                            <h4 class="item-price me-1">{{$settings->currency->currency_symbol}}{{$history->last_payment_amount}}</h4>

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


                        <div class="product-color-options mb-2">
                            @if($item->active != true)
                                <span class="badge badge-light-danger">Service status: Cancelled </span>
                            @else
                                <span class="badge badge-light-success">Service status: Active </span>
                            @endif
                        </div>



                        <p class="card-text">Last payment  - <span class="text-primary">
                             {{ \Carbon\Carbon::parse($history->last_payment_date)->translatedFormat(' j F Y')}}
                            </span></p>
                        @if($item->active)
                        <p class="card-text">Billing date - <span class="text-primary">: {{ \Carbon\Carbon::parse($history->next_due_date)->translatedFormat(' j F Y')}} </span></p>
                        @endif

                           @if($item->catalogue && $item->catalogue->tax)
                            <p class="card-text">Price - <span class="text-primary">: {{$settings->currency->currency_symbol}}{{ (($item->catalogue->tax->percentage / 100 ) * $item->catalogue->price) + $item->catalogue->price }}</span></p>
                            @endif

                            <div class="mb-2">
                                <span wire:loading class="badge badge-light-success">
                                    <span class= "spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...
                                </span>
                            </div>


                        @if(!$item->active)
                            @if($card)
                                <button type="button" wire:loading.remove target="resumeService" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0" wire:click="resumeService">
                                    Re-activate service
                                </button>
                                <button type="button" disabled wire:loading target="resumeService" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0">
                                    Processing payment...
                                </button>
                                <div>
                                    <small style="text-align: center" class="text-center mb-1">Your payment card will be used for this transaction, you can <a href="{{route('contact.payment-method')}}">click here</a> to update your card information</small>
                                </div>
                            @else
                                <div>
                                    <small style="text-align: center" class="text-center mb-1">Please update your payment information, <a href="{{route('contact.payment-method')}}">click here</a> to update your card</small>
                                </div>
                            @endif

                        @else
                            <button wire:loading.remove target="cancelService" type="button" class="btn btn-danger me-0 me-sm-1 mb-1 mb-sm-0" wire:click="cancelService">
                                Cancel service
                            </button>
{{--                            <button wire:loading target="cancelService" type="button" class="btn btn-danger me-0 me-sm-1 mb-1 mb-sm-0" disabled>--}}
{{--                                Processing request...--}}
{{--                            </button>--}}
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
