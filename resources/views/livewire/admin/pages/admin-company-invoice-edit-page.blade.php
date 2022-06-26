@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Invoice Details</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $invoice->company->id)}}">{{$invoice->company->name}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-invoices', $invoice->company->id)}}">Invoices</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <section class="invoice-add-wrapper">

            @livewire('admin-edit-invoice', ['invoice' => $invoice])


        </section>

    </div>
@endsection
