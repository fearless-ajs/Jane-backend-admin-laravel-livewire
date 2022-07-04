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
                            <img src="{{$user->userImage}}" class="rounded img-fluid" alt="Card image" />
                        </div>
                        <!-- profile title -->
                        <div class="profile-title ms-3">
                            <h2 class="text-white">{{$user->lastname. ' '. $user->firstname}}</h2>
                            <p class="text-white">{{$user->email}}</p>
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
                                        <a class="nav-link fw-bold" href="#" >
                                            <span class="d-none d-md-block">About</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item" style="margin-left: 10px">
                                        <a class="nav-link fw-bold active" href="#" data-bs-toggle="modal" data-bs-target="#editUserPrimaryProfileForm">
                                            <span class="d-none d-md-block">Update primary profile</span>
                                            <i data-feather="rss" class="d-block d-md-none"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- edit button -->
                                <a href="{{route('contact.payment-info')}}" class="btn btn-primary">
                                    <i data-feather="edit" class="d-block d-md-none"></i>
                                    <span class="fw-bold d-none d-md-block">Update other info</span>
                                </a>
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
            <!-- center profile info section -->
            <div class="col-lg-12 col-12 order-1 order-lg-2">
                <!-- post 1 -->
                <div class="card">
                    <div class="card-body">
                    {{--                        <p class="card-text">--}}
                    {{--                            {{$contact->description}}--}}
                    {{--                        </p>--}}

                    <!-- like share -->
                        <div class="row d-flex justify-content-start align-items-center flex-wrap pb-50">

                            <!-- share and like count and icons -->
                        </div>
                        <!-- like share -->

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <small>{{$user->billingAddress->phone}}</small>
                            </div>
                        </div>


                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">City</h6>
                                </div>
                                <small>{{$user->billingAddress->city}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">State</h6>
                                </div>
                                <small>{{$user->billingAddress->state}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <small>{{$user->billingAddress->country}}</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-1">
                            <div class="profile-user-info w-100">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <small>{{$user->billingAddress->address}}</small>
                            </div>
                        </div>



                        @if(!$user->enable_two_factor)
                            <button type="button" wire:loading.remove wire:target="requestTwoFactorAuthentication" wire:click="requestTwoFactorAuthentication" class="btn btn-sm btn-outline-success">Enable two factor authentication</button>
                        @else
                            <button type="button" wire:loading.remove wire:target="requestTwoFactorAuthentication" wire:click="requestTwoFactorAuthentication" class="btn btn-sm btn-outline-primary">Disable two factor authentication</button>
                        @endif
                        <button class="btn btn-sm btn-outline-success" type="button" disabled wire:loading wire:target="requestTwoFactorAuthentication" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

                        <br>
                        <small>
                            Two-Factor Authentication (2FA) works by adding an additional layer of security to you account.
                            It requires an additional login credential  which is a 6digit code that will be sent to your registered
                            email to verify your identity.
                        </small>
                    </div>
                </div>
                <!--/ post 1 -->
            </div>
            <!--/ center profile info section -->

        </div>
        <!--/ polls card -->

        @livewire('company-edit-user-primary-profile-form', ['user' => $user])

{{--        @livewire('company-edit-user-worker-info-form', ['user' => $user])--}}


</div>
