@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Invoices</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('company.invoices')}}">invoices</a>
                                </li>
                                <li class="breadcrumb-item active">Preview
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="invoice-preview-wrapper">
            @livewire('company-invoice-preview', ['invoice' => $invoice])
        </section>

        <!-- Send Invoice Sidebar -->
        @livewire('company-send-invoice-form', ['invoice' => $invoice])
        <!-- /Send Invoice Sidebar -->

    </div>
@endsection
