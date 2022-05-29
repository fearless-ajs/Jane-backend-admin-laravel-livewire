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
                                    <h6 wire:loading.remove wire:target="search" class="filter-heading">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->products)}} @endif results found</h6>
                                    <h6 wire:loading wire:target="search" class="filter-heading">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h6>
                                </div>

                            </div>
                            <div class="view-options d-flex">
                                <div class="btn-group dropdown-sort">
                                    @if(Auth::user()->hasModuleAccess('product', 'create'))
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                            Add product
                                        </button>
                                    @endif

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
                            <input type="text" wire:model="search" class="form-control search-product" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Search Bar Ends -->

            <!-- E-commerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">

                @if($products)
                    @foreach($products as $product)
                         <div class="card ecommerce-card">
                    <div class="item-img text-center">
                        <a href="{{route('company.product-details', $product->id)}}">
                            <img class="img-fluid card-img-top" src="{{$product->images->first()->productImage}}" alt="img-placeholder" /></a>
                    </div>
                    <div class="card-body">
                        <div class="item-wrapper">
                            <div class="item-rating">
                                <ul class="unstyled-list list-inline">
                                    <span class="badge badge-light-success">In stock: {{$product->quantity}} </span>
                                </ul>
                            </div>
                            <div>
                                <h6 class="item-price">{{$settings->app_currency_symbol}}{{$product->price}}</h6>
                            </div>
                        </div>
                        <h6 class="item-name">
                            <a class="text-body" href="#">{{$product->name}}</a>
                            <span class="card-text item-company">By <a href="#" class="company-name">{{$product->manufacturer}}</a></span>
                        </h6>
                        <p class="card-text item-description">
                            {{$product->description}}
                        </p>
                    </div>
                    <div class="item-options text-center">
                        <div class="item-wrapper">
                            <div class="item-cost">
                                <h4 class="item-price">₦ {{$product->price}}</h4>
                            </div>
                        </div>
                        @if(Auth::user()->hasModuleAccess('product', 'delete'))
                        <a href="#" wire:click="remove({{$product->id}})" class="btn btn-light btn-wishlist">
                            <span wire:loading wire:target="remove({{$product->id}})"  class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <i wire:loading.remove wire:target="remove({{$product->id}})"  class="fa fa-trash"></i>
                            <span>Remove</span>
                        </a>
                        @endif
                        <a href="{{route('company.product-details', $product->id)}}" class="btn btn-primary">
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
                        @if(!$searchResult)
                            {{ $products->links('components.general.pagination-links') /* For pagination links */}}
                        @endif
                    </div>
                </div>
            </section>
            <!-- E-commerce Pagination Ends -->

        </div>
    </div>


    <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
            <!-- Ecommerce Sidebar Starts -->
            <div class="sidebar-shop">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <!-- Price Range ends -->

                        <!-- Categories Starts -->
                        <div id="product-categories">
                            <h6 class="filter-title">Categories</h6>
                            <ul class="list-unstyled categories-list">

                                @if($categories)
                                    @foreach($categories as $category)
                                        <li>
                                            <div class="form-check">
                                                <input type="radio" id="{{$category->name}}" name="category-filter" class="form-check-input" value="{{$category->name}}" wire:model="category" />
                                                <label class="form-check-label" for="{{$category->name}}">{{$category->name}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        <!-- Categories Ends -->

                        <!-- Clear Filters Starts -->
                        <div id="clear-filters">
                            <button type="button" wire:click="clearFilter" class="btn w-100 btn-primary">Clear all filters</button>
                        </div>
                        <!-- Clear Filters Ends -->
                    </div>
                </div>
            </div>
            <!-- Ecommerce Sidebar Ends -->

        </div>
    </div>

    @if(Auth::user()->hasModuleAccess('product', 'create'))
        @livewire('company-create-product-form')
    @endif

</div>
