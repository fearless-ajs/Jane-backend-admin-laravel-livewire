@extends('layouts.auth.app')


@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">



        <div class="auth-wrapper auth-basic px-2">


            <div class="my-12 justify-content-center">
                <div style="text-align: center" class="mb-1">
                    <img src="{{$settings->AppImage}}" style="max-width: 5%; margin-right: -10px" />
                </div>

                <div class="card mb-0 col-9" style="margin: auto">
                    <div class="card-body">
                        <h2 class="mb-1 text-center text-primary font-large-1 mb-1">{{$settings->app_name}}</h2>
                        <p class="card-text mb-2 text-center">Create a company account on {{$settings->app_name}}</p>

                        @livewire('sign-up-form')


                        <p class="text-center" style="margin-top: 5px">
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
