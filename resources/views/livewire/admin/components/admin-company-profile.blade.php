<div>

    <!-- profile header -->
    <div class="row">
        <div class="col-12">
            <div class="card profile-header mb-2">
                <!-- profile cover photo -->
                <img class="card-img-top" src="{{$company->companyBanner}}" alt="User Profile Image" />
                <!--/ profile cover photo -->

                <div class="position-relative">
                    <!-- profile picture -->
                    <div class="profile-img-container d-flex align-items-center">
{{--                        <div class="profile-img">--}}
{{--                            <img src="{{$company->companyBanner}}" class="rounded img-fluid" alt="Card image" />--}}
{{--                        </div>--}}
                        <!-- profile title -->
                        <div class="profile-title ms-3 mb-3">
                            <h2 class="text-white">{{$company->name}}</h2>
                            <p class="text-white">{{$company->email}}</p>
                        </div>
                    </div>
                </div>

                <!-- tabs pill -->
                <div class="profile-header-nav">
                    <!-- navbar -->
                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                        <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i data-feather="align-justify" class="font-medium-5"></i>
                        </button>

                        <!-- collapse  -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                <ul class="nav nav-pills mb-0">
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold active" href="#" >
                                            <span class="d-none d-md-block">About contact</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" href="{{route('admin.company-contacts', $company->id)}}" >
                                            <span class="d-none d-md-block">Contacts({{count($company->contacts)}})</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" href="{{route('admin.company-users', $company->id)}}" >
                                            <span class="d-none d-md-block">Users({{count($company->users)}})</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" href="{{route('admin.company-products', $company->id)}}" >
                                            <span class="d-none d-md-block">Products({{count($company->products)}})</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" href="{{route('admin.company-services', $company->id)}}" >
                                            <span class="d-none d-md-block">Services({{count($company->services)}})</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" href="{{route('admin.company-invoices', $company->id)}}" >
                                            <span class="d-none d-md-block">Invoices({{count($company->invoices)}})</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold active" href="mailto:{{$company->email}}">
                                            <span class="d-none d-md-block">Mail</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- edit button -->
{{--                                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#editContactModal">--}}
{{--                                    <i data-feather="edit" class="d-block d-md-none"></i>--}}
{{--                                    <span class="fw-bold d-none d-md-block">Update</span>--}}
{{--                                </button>--}}
                            </div>
                        </div>
                        <!--/ collapse  -->
                    </nav>
                    <!--/ navbar -->
                </div>
            </div>
        </div>
    </div>
    <!--/ profile header -->

    <!-- profile info section -->
    <section id="profile-info">
        <div class="row">
            <!-- left profile info section -->
            <div class="col-lg-3 col-12 order-2 order-lg-1">
                <!-- about -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-75">Transactions</h5>
                        <p class="card-text">
                            This is the list of transactions carried out by the customer
                        </p>

{{--                        @if($contact->transactions)--}}
{{--                            @foreach($contact->transactions as $transaction)--}}
{{--                                <div class="mt-2">--}}
{{--                                    @if($transaction->product)--}}
{{--                                        <h5 class="mb-75">{{$transaction->product->name}}</h5>--}}
{{--                                        <p class="card-text">{{$transaction->created_at->diffForHumans()}}</p>--}}
{{--                                    @endif--}}
{{--                                    @if($transaction->service)--}}
{{--                                        <h5 class="mb-75">{{$transaction->service->name}}</h5>--}}
{{--                                        <p class="card-text">{{$transaction->created_at->diffForHumans()}}</p>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
                    </div>
                </div>
                <!--/ about -->
            </div>
            <!--/ left profile info section -->

            <!-- center profile info section -->
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <!-- avatar -->
                            <div class="avatar me-1">
                                <img src="{{$company->companyBanner}}" alt="avatar img" height="50" width="50" />
                            </div>
                            <!--/ avatar -->
                            <div class="profile-user-info">
                                <h6 class="mb-0">{{$company->name}}</h6>
                                <small class="text-muted">Joined {{$company->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <p class="card-text">
                            {{$company->address}}
                        </p>

                        <!-- like share -->
                        <div class="row d-flex justify-content-start align-items-center flex-wrap pb-50">

                            <!-- share and like count and icons -->
                            <div class="col-sm-6 d-flex justify-content-between justify-content-sm-end align-items-center mb-2">
{{--                                <a href="#" class="text-nowrap">--}}
{{--                                    <i  class="text-body font-medium-3 fa fa-phone"></i>--}}
{{--                                    <span class="text-muted me-1">Office: {{$contact->office_phone}}</span>--}}
{{--                                </a>--}}

                                <a href="#" class="text-nowrap">
                                    <i class="text-body font-medium-3 mx-50 fa fa-mobile"></i>
                                    <span class="text-muted">Mobile: {{$company->phone}}</span>
                                </a>
                            </div>

                            <div class="col-sm-6 d-flex justify-content-between justify-content-sm-start mb-2">
                                <a href="#" class="d-flex align-items-center text-muted text-nowrap">
                                    <i>Fax: {{$company->fax}}</i>
                                </a>
                            </div>

                            <!-- share and like count and icons -->
                            <div class="col-sm-6 d-flex justify-content-between justify-content-sm-end align-items-center mb-2">
                                <a href="#" class="text-nowrap">
                                    <i  class="text-body font-medium-3 fa fa-envelope"></i>
                                    <span class="text-muted me-1">Email: {{$company->email}}</span>
                                </a>

                                <a href="#" class="text-nowrap">
                                    <i class="text-body font-medium-3 mx-50 fa fa-calendar"></i>
                                    <span class="text-muted">last update: {{$company->updated_at}}</span>
                                </a>
                            </div>

                            <!-- share and like count and icons -->
                        </div>
                        <!-- like share -->

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">City</h6>
                                </div>
                                <small>{{$company->city}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">State</h6>
                                </div>
                                <small>{{$company->state}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <small>{{$company->country}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <small>{{$company->address}}</small>
                            </div>
                        </div>




                        @if($company->available)
                            <button type="button" class="btn btn-sm btn-success">Active contact</button>
                        @else
                            <button type="button" class="btn btn-sm btn-success">Inactive contact</button>
                        @endif
                    </div>
                </div>
                <!--/ post 1 -->
            </div>
            <!--/ center profile info section -->

        </div>
        <!--/ polls card -->

{{--        @livewire('company-edit-contact-form', ['contact' => $contact])--}}


</div>
