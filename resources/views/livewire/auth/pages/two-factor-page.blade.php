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
                        <h2 class="mb-1 text-center text-primary font-large-1 mb-2">{{$settings->app_name}}</h2>
                        <h4 class="card-title mb-1 text-center">Two Factor Verification</h4>
                        <p class="card-text mb-2 text-center">You have received an email which contains two factor login code</p>

                        @livewire('two-factor-form')


                        <p class="text-center mt-2">
                            <span>Want to sign in again?</span>
                            <a href="{{route('sign-out')}}">
                                <span>Sign out</span>
                            </a>
                        </p>

                        {{--                        <div class="divider my-2">--}}
                        {{--                            <div class="divider-text">or</div>--}}
                        {{--                        </div>--}}

                        <div class="auth-footer-btn d-flex justify-content-center">
                            {{--                            <a href="#" class="btn btn-facebook">--}}
                            {{--                                <i data-feather="facebook"></i>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="btn btn-twitter white">--}}
                            {{--                                <i data-feather="twitter"></i>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="btn btn-google">--}}
                            {{--                                <i data-feather="mail"></i>--}}
                            {{--                            </a>--}}
                            {{--                            <a href="#" class="btn btn-github">--}}
                            {{--                                <i data-feather="github"></i>--}}
                            {{--                            </a>--}}
                        </div>
                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
    <div class="content-header row">
    </div>

@endsection
