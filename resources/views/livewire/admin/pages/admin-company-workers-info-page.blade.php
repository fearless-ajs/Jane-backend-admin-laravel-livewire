@extends('layouts.admin.app')

@section('content')
    <div class="content-header row">

        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">User details</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $worker->company->id)}}">{{$worker->company->name}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.company-users', $worker->company->id)}}">Users</a>
                            </li>
                            <li class="breadcrumb-item active">{{$worker->user->lastname . '  ' .$worker->user->lastname}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @livewire('admin-company-workers-info', ['worker' => $worker])
@endsection
