@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Contacts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Contacts
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- users list start -->
        <section class="app-user-list">

            <div class="card">

                @livewire('admin-contact-list')

            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
