@extends('layouts.company.app')


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
                            <li class="breadcrumb-item"><a href="{{route('company.permissions')}}">Permissions</a>
                            </li>
                            <li class="breadcrumb-item active">{{$permission->name}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <h3>Permission Details</h3>
        <p>Details of the permissions and modifications can be made to the permission and access granted .</p>


        <!--/ Permission Table -->
        @livewire('edit-company-permission-form', ['company_permission_id' => $permission->id])

    </div>
@endsection
