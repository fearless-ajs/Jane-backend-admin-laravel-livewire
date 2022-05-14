@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <section class="invoice-list-wrapper">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <a href="#" class="btn btn-outline-success mb-1 mt-1 m-lg-1" >
                        {{$company->name}}
                    </a>
                    @livewire('admin-company-invoice-list', ['company' => $company])
                </div>
            </div>
        </section>

    </div>
@endsection
