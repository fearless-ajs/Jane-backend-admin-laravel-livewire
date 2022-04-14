@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <h3>Teams List</h3>
        <p class="mb-2">
            A team provided access to predefined menus and features so that depending <br />
            on assigned team an administrator can have access to what he need
        </p>

        <!-- Role cards -->
        @livewire('company-team-list')
        <!--/ Role cards -->

        <h3 class="mt-50">Total workers with their teams</h3>
        <p class="mb-2">Find all of your company’s workers accounts and their associate teams.</p>
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
        @livewire('company-create-team-form')
        <!--/ Add Role Modal -->

    </div>
@endsection
