@extends('layouts.auth.app')


@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <div style="text-align: center" class="mb-2">
                    <img src="{{$settings->AppImage}}" style="max-width: 10%; margin-right: -10px" />
                </div>
                <!-- Login basic -->
                <div class="card mb-0">

                    @livewire('reset-password-form', ['token' => $token])

                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
@endsection
