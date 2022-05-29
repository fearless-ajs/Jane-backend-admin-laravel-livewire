@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Roles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('company.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('company.roles')}}">Roles</a>
                            </li>
                            <li class="breadcrumb-item active">{{$role->name}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <h3>Role Details</h3>
        <p>Details of the roles and modifications can be made to the role and permission granted .</p>


        <!--/ Permission Table -->
        @livewire('company-edit-role-form', ['role' => $role])

    </div>
@endsection
