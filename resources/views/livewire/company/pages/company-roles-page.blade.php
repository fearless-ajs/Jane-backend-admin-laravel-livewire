@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <h3>Roles List</h3>
        <p class="mb-2">
            A role provided access to predefined menus and features so that depending <br />
            on assigned role an administrator can have access to what he need
        </p>

        <!-- Role cards -->
        @livewire('company-role-list')
        <!--/ Role cards -->

        <h3 class="mt-50">Total workers with their roles</h3>
        <p class="mb-2">Find all of your company’s administrator accounts and their associate roles.</p>
        <!-- table -->
        <div class="card">
            <div class="table-responsive">
                <table class="user-list-table table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Plan</th>
                        <th>Billing</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- table -->

        <!-- Add Role Modal -->
        @livewire('company-create-role-form')
        <!--/ Add Role Modal -->

    </div>
@endsection
