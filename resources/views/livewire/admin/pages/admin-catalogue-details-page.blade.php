@extends('layouts.admin.app')


@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">

                        @if($catalogue->type == 'product')
                        <h2 class="content-header-title float-start mb-0">Product Details</h2>
                        @endif
                       @if($catalogue->type == 'service')
                          <h2 class="content-header-title float-start mb-0">Service Details</h2>
                       @endif

                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                @if($catalogue->type == 'product')
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}">Products</a>
                                </li>
                                @endif
                                @if($catalogue->type == 'service')
                                    <li class="breadcrumb-item"><a href="{{route('admin.services')}}">Services</a>
                                    </li>
                                @endif

                                <li class="breadcrumb-item active">{{$catalogue->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @livewire('admin-catalogue-details', ['catalogue' => $catalogue])


    </div>
@endsection
