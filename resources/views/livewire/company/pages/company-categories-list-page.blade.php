@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <section class="app-user-list">
            <!-- list and filter start -->
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">Product category section</h4>
                    <div class="row">
                        <div class="col-md-4 user_role"></div>
                        <div class="col-md-4 user_plan"></div>
                        <div class="col-md-4 user_status"></div>
                    </div>
                </div>

                @livewire('company-category-list')

                <!-- Modal to add new user starts-->
                @livewire('company-create-category-form')
                <!-- Modal to add new user Ends-->
            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
