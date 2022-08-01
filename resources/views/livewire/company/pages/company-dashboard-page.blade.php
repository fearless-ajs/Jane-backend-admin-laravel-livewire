@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->

        @livewire('company-dashboard', ['company'   => $company])

        <!-- Dashboard Ecommerce ends -->

    </div>
@endsection
