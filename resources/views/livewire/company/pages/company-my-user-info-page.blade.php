@extends('layouts.company.app')


@section('content')

    <div class="content-body">
        <div id="user-profile">

            @livewire('company-my-user-profile', ['user' => $user])
        </div>
        <!--/ right profile info section -->

    </div>
@endsection
