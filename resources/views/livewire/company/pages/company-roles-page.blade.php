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
                            <li class="breadcrumb-item active">Roles
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <h3>Roles List</h3>
        <p class="mb-2">
            A role provided access to predefined menus and features so that depending <br />
            on assigned role an administrator can have access to what he need
        </p>

        <!-- Role cards -->
        @livewire('company-roles-list')
        <!--/ Role cards -->

        <!-- Add Role Modal -->
        @livewire('company-create-role-form')
        <!--/ Add Role Modal -->

    </div>
@endsection
