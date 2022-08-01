@extends('layouts.company.app')


@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Orders</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('company.invoices')}}">Invoices</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('company.preview-invoice', $invoice_id)}}">Preview</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Orders
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('company-invoice-order-list', ['invoice_id' => $invoice_id])

    </div>
@endsection
