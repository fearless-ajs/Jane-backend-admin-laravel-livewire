@extends('layouts.auth.app')


@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="auth-wrapper auth-basic px-2">
            <div class="auth-inner my-2">
                <!-- Login basic -->
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="index.html" class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <img src="{{$settings->AppImage}}" style="max-width: 10%; margin-right: -10px" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <h2 class="brand-text text-primary ms-1 mb-0">{{$settings->app_name}}</h2>
                        </a>
                        <p class="card-text mb-2 text-center">Create a company account on {{$settings->app_name}}</p>

                        @livewire('sign-up-form')


                        <p class="text-center mt-2">
                            <span>Already have an account?</span>
                            <a href="{{route('sign-in')}}">
                                <span>Sign in instead</span>
                            </a>
                        </p>

{{--                        <div class="divider my-2">--}}
{{--                            <div class="divider-text">or</div>--}}
{{--                        </div>--}}

{{--                        <div class="auth-footer-btn d-flex justify-content-center">--}}
{{--                            <a href="#" class="btn btn-facebook">--}}
{{--                                <i data-feather="facebook"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-google">--}}
{{--                                <i data-feather="mail"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- /Login basic -->
            </div>
        </div>

    </div>
@endsection
