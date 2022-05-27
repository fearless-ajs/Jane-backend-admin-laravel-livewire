@extends('layouts.auth.app')


@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <!-- Login basic -->
                <div class="card mb-0">

                    @livewire('reset-password-form', ['token' => $token])

                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
@endsection
