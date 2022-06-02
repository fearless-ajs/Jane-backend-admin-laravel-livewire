@extends('layouts.company.app')


@section('content')

    <div class="content-body">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Contacts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('company.contacts')}}">Contacts</a>
                                </li>
                                <li class="breadcrumb-item active">{{$contact->user->lastname. '  '. $contact->user->lastname }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="user-profile">

            @livewire('company-contact-profile', ['contact' => $contact])
        </div>
        <!--/ right profile info section -->


    </div>
@endsection
