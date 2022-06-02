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
                    <div class="card-body">

                        <h2 class="mb-1 text-center text-primary font-large-1 mb-2">{{$settings->app_name}}</h2>
                        <h4 class="card-title mb-1 text-center">Forgot Password? 🔒</h4>
                        <p class="card-text mb-2 text-center">Enter your email and we'll send you instructions to reset your password</p>

                        @livewire('forgot-password-form')


                        <p class="text-center mt-2">
                            <a href="{{route('sign-in')}}">
                                <span>Back to login</span>
                            </a>
                        </p>

                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
@endsection
