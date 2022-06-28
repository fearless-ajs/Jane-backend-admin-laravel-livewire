@extends('layouts.admin.app')


@section('content')
    <div class="content-body">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Permissions</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.companies')}}">Companies</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.company-profile', $company->id)}}">{{$company->name}}</a>
                            </li>
                            <li class="breadcrumb-item active">Permissions
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Permission Table -->
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
            Create permission
        </button>
        @livewire('admin-company-permission-list', ['company' => $company])
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
         @livewire('create-permission-form', ['company' => $company])
        <!--/ Add Permission Modal -->

    </div>
@endsection
