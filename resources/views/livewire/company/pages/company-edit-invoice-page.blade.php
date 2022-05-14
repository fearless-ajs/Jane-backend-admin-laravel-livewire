@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <section class="invoice-add-wrapper">

            @livewire('company-edit-invoice', ['invoice' => $invoice])


        </section>
    </div>
@endsection
