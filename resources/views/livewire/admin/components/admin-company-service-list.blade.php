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
                                <div class="search-results">16285 results found</div>
                            </div>
                            <div class="view-options d-flex">
                                <div class="btn-group dropdown-sort">
{{--                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">--}}
{{--                                        Add service--}}
{{--                                    </button>--}}
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle me-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="active-sorting">Featured</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Featured</a>
                                        <a class="dropdown-item" href="#">Lowest</a>
                                        <a class="dropdown-item" href="#">Highest</a>
                                    </div>
                                </div>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="radio_options" id="radio_option1" autocomplete="off" checked />
                                    <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn" for="radio_option1"><i data-feather="grid" class="font-medium-3"></i></label>
                                    <input type="radio" class="btn-check" name="radio_options" id="radio_option2" autocomplete="off" />
                                    <label class="btn btn-icon btn-outline-primary view-btn list-view-btn" for="radio_option2"><i data-feather="list" class="font-medium-3"></i></label>
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
            <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control search-product" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Search Bar Ends -->

            <!-- E-commerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">

                @if($services)
                    @foreach($services as $service)
                        <div class="card ecommerce-card mb-2">
                            {{--                            <div class="item-img text-center">--}}
                            {{--                                <a href="app-ecommerce-details.html">--}}
                            {{--                                    <img class="img-fluid card-img-top" src="{{$service->serviceImage}}" alt="img-placeholder" /></a>--}}
                            {{--                            </div>--}}
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h6 class="item-price">₦{{$service->price}}</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="#">{{$service->name}}</a>
                                    <span class="card-text item-company">By <a href="#" class="company-name">{{$service->manufacturer}}</a></span>
                                </h6>
                                <p class="card-text item-description">
                                    {{$service->description}}
                                </p>
                            </div>
                            <div class="item-options text-center mb-2">
                                <div class="item-wrapper">

                                    <div class="item-cost">
                                        <h4 class="item-price">₦ {{$service->price}}</h4>
                                    </div>
                                </div>
                                <a href="#" wire:click="remove({{$service->id}})" class="btn btn-light btn-wishlist">
                                    <span wire:loading wire:target="remove({{$service->id}})"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    <i wire:loading.remove wire:target="remove({{$service->id}})"  class="fa fa-trash"></i>
                                    <span>Remove</span>
                                </a>
                                <a href="{{route('admin.company-service-details', $service->id)}}" class="btn btn-primary">
                                    <span>See details</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif


            </section>
            <!-- E-commerce Products Ends -->

            <!-- E-commerce Pagination Starts -->
            <section id="ecommerce-pagination">
                <div class="row">
                    <div class="col-sm-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-2">
                                <li class="page-item prev-item"><a class="page-link" href="#"></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item" aria-current="page"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item next-item"><a class="page-link" href="#"></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
            <!-- E-commerce Pagination Ends -->

        </div>
    </div>


</div>
