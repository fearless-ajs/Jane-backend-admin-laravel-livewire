@extends('layouts.auth.app')


@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <div style="text-align: center" class="mb-2">
                    <img src="{{$settings->AppImage}}" style="max-width: 20%; margin-right: -10px" />
                </div>
                <!-- Login basic -->
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="index.html" class="brand-logo">
                            <h2 class="brand-text text-primary ms-1 mb-0">{{$settings->app_name}}</h2>
                        </a>

                        @livewire('verify-email-card', ['token' => $token])

                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
@endsection
