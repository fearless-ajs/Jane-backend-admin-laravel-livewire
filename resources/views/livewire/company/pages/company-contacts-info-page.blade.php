@extends('layouts.company.app')


@section('content')

    <div class="content-body">
        <div id="user-profile">

            @livewire('company-contact-profile', ['contact' => $contact])
        </div>
        <!--/ right profile info section -->


    </div>
@endsection
