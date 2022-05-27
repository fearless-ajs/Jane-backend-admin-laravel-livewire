<div class="content-body">
    <!-- app e-commerce details start -->
    @if($missing)
    <section class="app-ecommerce-details">
        <div class="card">
            <div class="card-body">
                <div class="row my-2">
                        <h3>Product not found!</h3>
                </div>
            </div>
        </div>

    </section>
    @else

    <section class="app-ecommerce-details">

        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{$product->images->first()->productImage}}" class="img-fluid product-img" alt="product image" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4>{{$product->name}}</h4>
                        <span class="card-text item-company">By <a href="#" class="company-name">{{$product->manufacturer}}</a></span>
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                            <h4 class="item-price me-1">₦{{$product->price}}</h4>
                            <ul class="unstyled-list list-inline ps-1 border-start">
                                <span class="badge badge-light-success">Category: {{$product->category}} </span>
                            </ul>
                        </div>
                        @if($product->active)
                            <p class="card-text">Available - <span class="text-success">In stock</span></p>
                        @else
                            <p class="card-text">Not Available - <span class="text-success">Out of stock</span></p>
                        @endif

                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <ul class="product-features list-unstyled">
                            <li>
                                <i data-feather="dollar-sign"></i>
                                <span>{{$product->brand}}</span>
                            </li>
                            <li><i class="fa fa-user"></i> <span>{{$product->user->lastname}} {{$product->user->firstname}}</span></li>
                        </ul>
                        <hr />
                        <div class="product-color-options">
                            <h6>Other product information</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block selected">
                                    <div class="color-option b-primary">
                                        <div class="filloption bg-primary"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr />
                        <div class="d-flex flex-column flex-sm-row pt-1">
                            <button type="button" class="btn btn-outline-success me-0 me-sm-1 mb-1 mb-sm-0" data-bs-toggle="modal" data-bs-target="#productLinkModal">
                                Generate link
                            </button>
                            <a href="{{route('company.products')}}" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                                <i data-feather="heart" class="me-50"></i>
                                <span>Shop</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details ends -->
        </div>



        <div class="modal fade current-modal" wire:ignore.self id="productLinkModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Product link</h1>
                            <a target="_blank" href="{{getenv('APP_PUBLIC_URL')}}/markets/{{$product->company->id}}/{{$product->slug}}">{{getenv('APP_PUBLIC_URL')}}/markets/{{$product->company->id}}/{{$product->slug}}</a>
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
                        <h4 class="justify-content-center" style="text-align: center;">Product images
                            <span wire:loading wire:target="removeImage"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>
                        @if(count($product->images) > 0)
                            @foreach($product->images as $image)
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{$image->productImage}}" class="img-fluid product-img" alt="product image" />
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- Product Details ends -->
            </div>
        </section>
    @endif



</div>
