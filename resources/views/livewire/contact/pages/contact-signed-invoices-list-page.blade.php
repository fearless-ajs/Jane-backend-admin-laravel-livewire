@extends('layouts.contact.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Invoices</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('contact.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Invoices
                                </li>
{{--                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $company->id)}}">{{$company->name}}</a>--}}
{{--                                </li>--}}
{{--                                <li class="breadcrumb-item active">Invoices--}}
{{--                                </li>--}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="invoice-list-wrapper">
            <div class="card">
                <div class="card-datatable table-responsive">
                    @livewire('contact-signed-invoice-list')
                </div>
            </div>
        </section>

    </div>
@endsection
