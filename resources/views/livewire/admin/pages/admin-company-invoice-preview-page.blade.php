@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <section class="invoice-preview-wrapper">
            @livewire('admin-company-invoice-preview', ['invoice' => $invoice])
        </section>

        <!-- Send Invoice Sidebar -->
        @livewire('company-send-invoice-form', ['invoice' => $invoice])
        <!-- /Send Invoice Sidebar -->

    </div>
@endsection
