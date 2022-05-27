@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Company contacts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $company->id)}}">{{$company->name}}</a>
                                </li>
                                <li class="breadcrumb-item active">Contacts
                                </li>
                                {{--                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $product->company->id)}}">{{$product->company->name}}</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="breadcrumb-item"><a href="{{route('admin.company-products', $product->company->id)}}">Products</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="breadcrumb-item active">{{$product->name}}--}}
                                {{--                                </li>--}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <section class="app-user-list">
            <!-- list and filter start -->

            @livewire('admin-company-contact-list', ['company' => $company])

            <!-- list and filter end -->
        </section>
        <!-- users list ends -->

    </div>
@endsection
