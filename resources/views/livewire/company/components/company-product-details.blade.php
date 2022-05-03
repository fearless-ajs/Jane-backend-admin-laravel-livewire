<div class="content-body">
    <!-- app e-commerce details start -->
    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{$product->productImage}}" class="img-fluid product-img" alt="product image" />
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <h4>{{$product->name}}</h4>
                        <span class="card-text item-company">By <a href="#" class="company-name">{{$product->manufacturer}}</a></span>
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                            <h4 class="item-price me-1">₦{{$product->price}}</h4>
                            <ul class="unstyled-list list-inline ps-1 border-start">
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
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
                            <button type="button" class="btn btn-primary me-0 me-sm-1 mb-1 mb-sm-0" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                Update product
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

        @livewire('company-edit-product-form', ['product' => $product])
    </section>
    <!-- app e-commerce details end -->

</div>
