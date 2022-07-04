@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Billing</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Billing cycles
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- users list start -->
        <section class="app-user-list">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">Billing cycles</h4>
                    <div class="row">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>

                @livewire('company-billing-cycle-list', ['company' => $company])

                @if(Auth::user()->hasModuleAccess('billing-cycle', 'create'))
                <!-- Modal to add new user starts-->
                @livewire('company-create-billing-cycle-form', ['company' => $company])
                <!-- Modal to add new user Ends-->
                @endif
            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
