<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>{{Auth::user()->company->name}}</h5>
                    <p class="card-text font-small-3">Dashboard</p>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="#">{{ \Carbon\Carbon::now()->translatedFormat(' j F Y')}}</a>
                    </h3>
                    <a href="{{route('company.orders')}}" type="button" class="btn btn-primary">View Sales</a>
                    <img src="{{asset('app-assets/images/illustration/badge.svg')}}" class="congratulation-medal" alt="Medal Pic" />
                </div>
            </div>
        </div>
        <!--/ Medal Card -->

        <!-- Statistics Card -->
        <div class="col-xl-8 col-md-6 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 me-25 mb-0">Updated just now</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-primary me-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$totalSales}}</h4>
                                    <p class="card-text font-small-3 mb-0">Sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-info me-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{count($company->contacts)}}</h4>
                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-danger me-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{count($company->catalogues)}}</h4>
                                    <p class="card-text font-small-3 mb-0">Catalog</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-success me-2">
                                    <div class="avatar-content">
                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{$settings->currency->currency_symbol}}{{number_format($totalRevenue)}}</h4>
                                    <p class="card-text font-small-3 mb-0">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>


    <div class="row match-height">
        <!-- Company Table Card -->
        <div class="col-lg-8 col-12">
           @livewire('company-top-sold-products', ['company_id' => $company->id])
        </div>
        <!--/ Company Table Card -->

        <!-- Developer Meetup Card -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-developer-meetup">
                <div class="card-body">
                    <div class="meetup-header d-flex align-items-center">
                        <div class="meetup-day">
                            <h6 class="mb-0">{{ \Carbon\Carbon::now()->translatedFormat('F')}}</h6>
                            <h3 class="mb-0">{{ \Carbon\Carbon::now()->translatedFormat(' j')}}</h3>
                        </div>
                        <div class="my-auto">
                            <h4 class="card-title mb-25">SERVICE REPORT CHART</h4>
                            <p class="card-text mb-0">Most used company services</p>
                        </div>
                    </div>
                    <div class="mt-0">

                        @livewire('company-top-sold-services', ['company_id' => $company->id])

                    </div>
                </div>
            </div>
        </div>
        <!--/ Developer Meetup Card -->

        <!-- Browser States Card -->
{{--        <div class=" col-12">--}}
{{--            <div class="card card-browser-states">--}}
{{--                <div class="card-header">--}}
{{--                    <div>--}}
{{--                        <h4 class="card-title">Sales report</h4>--}}
{{--                        <p class="card-text font-small-2">Generated: {{ \Carbon\Carbon::now()->translatedFormat(' j F Y')}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="dropdown chart-dropdown">--}}
{{--                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>--}}
{{--                        <div class="dropdown-menu dropdown-menu-end">--}}
{{--                            <a class="dropdown-item" href="#">Last 28 Days</a>--}}
{{--                            <a class="dropdown-item" href="#">Last Month</a>--}}
{{--                            <a class="dropdown-item" href="#">Last Year</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}




{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!--/ Browser States Card -->
    </div>
</section>
