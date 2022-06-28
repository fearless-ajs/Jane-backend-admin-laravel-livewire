@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Company users</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $company->id)}}">{{$company->name}}</a>
                                </li>
                                <li class="breadcrumb-item active">Categories
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <section class="app-user-list">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">Category section</h4>
                    <div class="row">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>

                @livewire('company-category-list', ['company' => $company])

                @livewire('company-create-category-form', ['company' => $company])
            </div>
            <!-- list and filter end -->
        </section>

    </div>
@endsection
