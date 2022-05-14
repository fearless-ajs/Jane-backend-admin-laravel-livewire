@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <section class="app-user-list">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">21,459</h3>
                                <span>Total Contacts</span>
                            </div>
                            <div class="avatar bg-light-primary p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">4,567</h3>
                                <span>Paid Contact</span>
                            </div>
                            <div class="avatar bg-light-danger p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-plus" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">19,860</h3>
                                <span>Active Contacts</span>
                            </div>
                            <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">237</h3>
                                <span>Pending Contacts</span>
                            </div>
                            <div class="avatar bg-light-warning p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-x" class="font-medium-4"></i>
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">Search & Filter</h4>
                    <div class="row">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>

                @livewire('admin-company-contact-list', ['company' => $company])


            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
