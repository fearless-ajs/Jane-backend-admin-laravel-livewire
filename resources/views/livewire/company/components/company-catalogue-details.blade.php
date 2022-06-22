<div class="content-body">
    <!-- app e-commerce details start -->
    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{$catalogue->images->first()->picture}}" class="img-fluid product-img" alt="product image" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4>{{$catalogue->name}}</h4>
                        @if($catalogue->type === 'product')
                            <span class="card-text item-company">By <a href="#" class="company-name">{{$catalogue->manufacturer}}</a></span>
                        @endif
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                            @if($catalogue->tax)
                                <h4 class="item-price me-1"><span class="text-warning"> {{$settings->currency->currency_symbol}}{{$catalogue->price}} <small>+ Tax: {{$catalogue->tax->percentage}}%</small> </span>| Total: {{$settings->currency->currency_symbol}}{{ (($catalogue->tax->percentage / 100 ) * $catalogue->price) + $catalogue->price }}</h4>
                            @else
                                <h4 class="item-price me-1">{{$settings->currency->currency_symbol}}{{$catalogue->price}}</h4>
                            @endif

                            @if($catalogue->category)
                            <ul class="unstyled-list list-inline ps-1 border-start">
                                <span class="badge badge-light-success">Category: {{$catalogue->category}} </span>
                            </ul>
                            @endif
                        </div>

                        @if($catalogue->type === 'product')
                            @if($catalogue->quantity > 0)
                                <p class="card-text">Available - <span class="text-success">In stock</span></p>
                            @else
                                <p class="card-text">Not Available - <span class="text-success">Out of stock</span></p>
                            @endif
                        @endif
                        @if($catalogue->type === 'service')
                            @if($catalogue->cycle)
                                <p class="card-text">Billing - <span class="text-success">{{$catalogue->cycle->title}}</span></p>
                            @else
                                <p class="card-text">Billing - <span class="text-danger">Not available</span></p>
                            @endif
                        @endif


                        <p class="card-text">
                            {{$catalogue->description}}
                        </p>
                        <ul class="product-features list-unstyled">
                            @if($catalogue->type === 'product')
                                <li>
                                    <i>Brand:</i>
                                    <span>{{$catalogue->brand}}</span>
                                </li>
                            @endif
                                <li><i class="fa fa-user"></i> <span>{{$catalogue->user->lastname}} {{$catalogue->user->firstname}}</span></li>
                        </ul>
                        <hr />
                        @if($catalogue->type === 'product')
                            <div class="product-color-options">
                                <h6>Other product information</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-inline-block selected">
                                        <div class="color-option b-primary">
                                            <div class="filloption bg-primary"></div>
                                        </div>
                                    </li>
                                </ul>
                                <p class="card-text">Available quantity - <span class="text-success">{{$catalogue->quantity}}</span></p>
                            </div>
                            <hr />
                        @endif
                        <div class="d-flex flex-column flex-sm-row pt-1">

                            @if(Auth::user()->hasModuleAccess('product', 'edit'))
                                <button type="button" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0" data-bs-toggle="modal" data-bs-target="#editCatalogueModal">
                                    Update {{$catalogue->type}}
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-success me-0 me-sm-1 mb-1 mb-sm-0" data-bs-toggle="modal" data-bs-target="#productLinkModal">
                                Generate link
                            </button>
                            <a href="{{route('company.catalogues')}}" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                                <i class="me-50 fa fa-heart"></i>
                                <span>Shop</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details ends -->
        </div>


        @if(Auth::user()->hasModuleAccess('product', 'edit'))
            @livewire('company-edit-catalogue-form', ['catalogue' => $catalogue])
        @endif


        <div class="modal fade current-modal" wire:ignore.self id="productLinkModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Product link</h1>
                            <a target="_blank" href="{{getenv('APP_PUBLIC_URL')}}/markets/{{$catalogue->company->id}}/{{$catalogue->slug}}">{{getenv('APP_PUBLIC_URL')}}/markets/{{$catalogue->company->id}}/{{$catalogue->slug}}</a>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                Share link
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- app e-commerce details end -->

    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row">
                    <h4 class="justify-content-center" style="text-align: center;">{{ucwords($catalogue->type)}} images
                        <span wire:loading wire:target="removeImage"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>
                    @if(count($catalogue->images) > 0)
                        @foreach($catalogue->images as $image)
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{$image->picture}}" class="img-fluid product-img" alt="product image" />
                                    <span wire:loading.remove wire:target="removeImage({{$image->id}})" wire:click="removeImage({{$image->id}})" style="cursor:pointer;" class="fa fa-trash"></span>

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
