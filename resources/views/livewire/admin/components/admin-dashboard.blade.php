<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>{{$settings->app_name}} Dashboard!</h5>
                    <p class="card-text font-small-3">System control panel</p>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="#">{{ \Carbon\Carbon::now()->translatedFormat(' j F Y')}}</a>
                    </h3>
                    <a href="{{route('admin.companies')}}" class="btn btn-primary">View companies</a>
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
                        <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="d-flex flex-row">
                                <div class="avatar bg-light-primary me-2">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h4 class="fw-bolder mb-0">{{count($companiesCount)}}</h4>
                                    <p class="card-text font-small-3 mb-0">Companies</p>
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
                                    <h4 class="fw-bolder mb-0">{{count($contacts)}}</h4>
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
                                    <h4 class="fw-bolder mb-0">{{count($catalog)}}</h4>
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

        <!-- Revenue Report Card -->
        <div class="col-lg-12 col-12">
            <div class="card card-company-table">
                <div class="card-body p-0">
                    <h4 class="fw-bolder mb-2 mt-2" style="padding-left: 20px;">Recent companies</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Company</th>
                                <th>Staff</th>
                                <th>Contacts</th>
                                <th>Catalog</th>
                                <th>Invoices</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(count($companies) > 0)
                                @foreach($companies as $company)
                                    <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar rounded">
                                            <div class="avatar-content">
                                                <img src="{{asset('app-assets/images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="fw-bolder">{{$company->name}}</div>
                                            <div class="font-small-2 text-muted">{{$company->email}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                                <i data-feather="users" class="font-medium-3"></i>
                                            </div>
                                        </div>
                                        <span>{{count($company->users)}}</span>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder mb-25">{{count($company->contacts)}}</span>
                                        <span class="font-small-2 text-muted">Since {{ \Carbon\Carbon::parse($company->created_at)->translatedFormat(' j F Y')}}</span>
                                    </div>
                                </td>
                                <td>{{count($company->catalogues)}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bolder me-1">{{count($company->invoices)}}</span>
                                        <i data-feather="file" class="text-primary font-medium-1"></i>
                                    </div>
                                </td>
                            </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Revenue Report Card -->


        <!-- Company Table Card -->
        <div class="col-lg-8 col-12">
            @livewire('admin-top-sold-products')
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
                            <p class="card-text mb-0">Most used {{$settings->app_name}} services</p>
                        </div>
                    </div>
                    <div class="mt-0">

                        @livewire('admin-top-sold-services')

                    </div>
                </div>
            </div>
        </div>
        <!--/ Developer Meetup Card -->
    </div>

</section>
