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
        <!-- Edit Permission Modal -->
        <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3 pt-0">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Edit Permission</h1>
                            <p>Edit permission as per your requirements.</p>
                        </div>

                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading">Warning!</h6>
                            <div class="alert-body">
                                By editing the permission name, you might break the system permissions functionality. Please ensure you're
                                absolutely certain before proceeding.
                            </div>
                        </div>

                        <form id="editPermissionForm" class="row" onsubmit="return false">
                            <div class="col-sm-9">
                                <label class="form-label" for="editPermissionName">Permission Name</label>
                                <input type="text" id="editPermissionName" name="editPermissionName" class="form-control" placeholder="Enter a permission name" tabindex="-1" data-msg="Please enter permission name" />
                            </div>
                            <div class="col-sm-3 ps-sm-0">
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </div>
                            <div class="col-12 mt-75">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editCorePermission" />
                                    <label class="form-check-label" for="editCorePermission"> Set as core permission </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit Permission Modal -->

    </div>
@endsection
