@extends('layouts.admin.app')


@section('content')

    <div class="content-body">
        <div id="user-profile">

            @livewire('admin-company-profile', ['company' => $company])
        </div>
        <!--/ right profile info section -->


    </div>
@endsection
