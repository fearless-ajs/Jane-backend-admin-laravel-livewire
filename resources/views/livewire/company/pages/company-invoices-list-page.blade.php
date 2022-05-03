@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <section class="invoice-list-wrapper">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <a href="{{route('company.create-invoice')}}" class="btn btn-primary mb-1 mt-1 m-lg-1" >
                        Create invoice
                    </a>
                    @livewire('company-invoice-list')
                </div>
            </div>
        </section>

    </div>
@endsection
