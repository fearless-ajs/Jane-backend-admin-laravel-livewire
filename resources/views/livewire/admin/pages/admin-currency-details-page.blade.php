@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <!-- users list start -->
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Currencies</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.currencies')}}">currencies</a>
                                </li>
                                <li class="breadcrumb-item active">{{$currency->currency_name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <section class="app-user-list">

            @livewire('admin-currency-details', ['currency'   => $currency])

            @livewire('admin-edit-currency-form', ['currency'   => $currency])


        </section>
        <!-- users list ends -->

    </div>
@endsection
