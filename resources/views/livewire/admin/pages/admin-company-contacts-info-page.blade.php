@extends('layouts.admin.app')


@section('content')

    <div class="content-body">
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Company contacts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $contact->company->id)}}">{{$contact->company->name}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.company-contacts', $contact->company->id)}}">Contacts</a>
                                </li>
                                <li class="breadcrumb-item active">{{$contact->user->lastname. '  ' . $contact->user->firstname}}
                                </li>
                                {{--                                <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $product->company->id)}}">{{$product->company->name}}</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="breadcrumb-item"><a href="{{route('admin.company-products', $product->company->id)}}">Products</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="breadcrumb-item active">{{$product->name}}--}}
                                {{--                                </li>--}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="user-profile">

            @livewire('admin-company-contact-profile', ['contact' => $contact])
        </div>
        <!--/ right profile info section -->

    </div>
@endsection
