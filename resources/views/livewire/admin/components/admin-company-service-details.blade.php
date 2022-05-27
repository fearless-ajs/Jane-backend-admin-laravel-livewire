<div class="content-body">
    <!-- app e-commerce details start -->
    <section class="app-ecommerce-details">
        <div class="card">
            <!-- Product Details starts -->
            <div class="card-body">
                <div class="row my-2">
                    <div class="col-12 col-md-7">
                        <h4>{{$service->name}}</h4>
                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                            <h4 class="item-price me-1">{{$settings->app_currency_symbol}}{{$service->price}}</h4>
                            <ul class="unstyled-list list-inline ps-1 border-start">
                                <span class="badge badge-light-success">{{$service->usage_unit}} </span>
                            </ul>
                        </div>
                        @if($service->active)
                            <p class="card-text">Available - <span class="text-success">In service</span></p>
                        @else
                            <p class="card-text">Not Available - <span class="text-success">Out of service</span></p>
                        @endif

                        <p class="card-text">
                            {{$service->description}}
                        </p>
                        <ul class="product-features list-unstyled">
                            <li><i class="fa fa-user"></i> <span>{{$service->user->lastname}} {{$service->user->firstname}}</span></li>
                        </ul>
                        <hr />
                        <div class="product-color-options">
                            <h6>Other service information</h6>
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
                            <a href="{{route('admin.company-services', $service->company->id)}}" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                                <i data-feather="heart" class="me-50"></i>
                                <span>Company services</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service Details ends -->
        </div>

        @livewire('company-edit-service-form', ['service' => $service])
    </section>
    <!-- app e-commerce details end -->

</div>
