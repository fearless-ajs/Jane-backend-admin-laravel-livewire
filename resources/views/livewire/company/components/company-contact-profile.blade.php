<div>

    <!-- profile header -->
    <div class="row">
        <div class="col-12">
            <div class="card profile-header mb-2">
                <!-- profile cover photo -->
                <img class="card-img-top" src="{{asset('app-assets/images/profile/user-uploads/timeline.jpg')}}" alt="User Profile Image" />
                <!--/ profile cover photo -->

                <div class="position-relative">
                    <!-- profile picture -->
                    <div class="profile-img-container d-flex align-items-center">
                        <div class="profile-img">
                            <img src="{{$contact->ContactImage}}" class="rounded img-fluid" alt="Card image" />
                        </div>
                        <!-- profile title -->
                        <div class="profile-title ms-3">
                            <h2 class="text-white">{{$contact->title. ' ' .$contact->lastname. ' '. $contact->firstname}}</h2>
                            <p class="text-white">{{$contact->email}}</p>
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
                                        <a class="nav-link fw-bold" href="mailto:{{$contact->email}}">
                                            <span class="d-none d-md-block">Mail</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                </ul>
                               @if(Auth::user()->hasModuleAccess('contact', 'edit'))
                                <!-- edit button -->
                                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#editContactModal">
                                    <i data-feather="edit" class="d-block d-md-none"></i>
                                    <span class="fw-bold d-none d-md-block">Update</span>
                                </button>
                                @endif
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

                        @if($contact->transactions)
                            @foreach($contact->transactions as $transaction)
                                <div class="mt-2">
                                    @if($transaction->product)
                                        <h5 class="mb-75">{{$transaction->product->name}}</h5>
                                        <p class="card-text">{{$transaction->created_at->diffForHumans()}}</p>
                                    @endif
                                    @if($transaction->service)
                                        <h5 class="mb-75">{{$transaction->service->name}}</h5>
                                        <p class="card-text">{{$transaction->created_at->diffForHumans()}}</p>
                                    @endif
                                </div>
                            @endforeach
                        @endif
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
                                <img src="{{$contact->user->userImage}}" alt="avatar img" height="50" width="50" />
                            </div>
                            <!--/ avatar -->
                            <div class="profile-user-info">
                                <h6 class="mb-0">{{$contact->title. ' ' .$contact->user->lastname. ' '. $contact->user->firstname}}</h6>
                                <small class="text-muted">Joined {{$contact->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        <p class="card-text">
                           {{$contact->description}}
                        </p>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Date of birth</h6>
                                </div>
                                <small>{{$contact->date_of_birth}}</small>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <small>{{$contact->user->email}}</small>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Office phone</h6>
                                </div>
                                <small>{{$contact->office_phone}}</small>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Mobile phone</h6>
                                </div>
                                <small>{{$contact->mobile_phone}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Fax</h6>
                                </div>
                                <small>{{$contact->fax}}</small>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">City</h6>
                                </div>
                                <small>{{$contact->city}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">State</h6>
                                </div>
                                <small>{{$contact->state}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">City</h6>
                                </div>
                                <small>{{$contact->city}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">State</h6>
                                </div>
                                <small>{{$contact->state}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <small>{{$contact->country}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <small>{{$contact->address}}</small>
                            </div>
                        </div>




                        @if($contact->available)
                        <p  class="text-success">Active contact</p>
                        @else
                        <p  class="text-danger">Inactive contact</p>
                        @endif
                    </div>
                </div>
                <!--/ post 1 -->
            </div>
            <!--/ center profile info section -->

        </div>
        <!--/ polls card -->

        @if(Auth::user()->hasModuleAccess('contact', 'edit'))
        @livewire('company-edit-contact-form', ['contact' => $contact])
        @endif


</div>
