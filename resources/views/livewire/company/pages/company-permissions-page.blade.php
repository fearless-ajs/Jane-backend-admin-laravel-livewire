@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <h3>Permissions List</h3>
        <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>

        <!-- Permission Table -->
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
            Create permission
        </button>
        @livewire('company-permission-list')
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 pb-5">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Add New Permission</h1>
                            <p>Permissions you may use and assign to your workers.</p>
                        </div>

                        @livewire('create-permission-form')

                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Permission Modal -->

    </div>
@endsection
