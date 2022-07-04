@extends('layouts.error.app')


@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Not authorized-->
            <div class="misc-wrapper">
                <a class="brand-logo" href="{{route('login')}}">
{{--                    <img src="{{$settings->AppImage}}" style=" max-width: 5%;" />--}}
                    <h2 class="brand-text text-primary ms-1">{{$settings->app_name}}</h2>
                </a>
                <div class="misc-inner p-2 p-sm-3">
                    <div class="w-100 text-center">
                        <h2 class="mb-1">You are not authorized! 🔐</h2>
                        <p class="mb-2">
                            You are currently not authorized to access this page, you privileges might have been revoked by the system administrator .
                        </p>
                        @if(Auth::user())
                            <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('sign-out')}}">Back home</a>
                        @else
                            <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('sign-in')}}">Back to login</a>
                        @endif
                        <img class="img-fluid" src="{{asset('app-assets/images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
                    </div>
                </div>
            </div>
            <!-- / Not authorized-->
        </div>
    </div>
@endsection
