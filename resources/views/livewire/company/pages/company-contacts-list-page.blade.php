@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Contacts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
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

                @livewire('company-contact-list')

                @if(Auth::user()->hasModuleAccess('contact', 'create'))
                <!-- Modal to add new user starts-->
                @livewire('company-create-contact-form', ['company' => $company])
                <!-- Modal to add new user Ends-->
                @endif

            </div>
            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
