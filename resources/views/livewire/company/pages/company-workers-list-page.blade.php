@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Staff</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Staff
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="app-user-list">
            <!-- list and filter start -->

            @livewire('company-worker-list')

            <!-- Modal to add new user starts-->
            @livewire('company-create-worker-form')
            <!-- Modal to add new user Ends-->        </section>
        <!-- users list ends -->

    </div>
@endsection
