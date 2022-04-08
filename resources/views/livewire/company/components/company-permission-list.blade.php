<div class="card">
    <div class="card-datatable table-responsive">
        <table class="datatables-permissions table">
            <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Created Date</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @if($permissions)
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->display_name}}</td>
                        <td>{{$permission->description}}</td>
                        <td>{{$permission->created_at->diffForHumans()}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" wire:click="setEditPermission({{$permission->id}})" data-bs-toggle="modal" data-bs-target="#editPermissionModal">
                                Edit
                            </button>
                        </td>
                        <td>
                            <button type="button" wire:click="remove({{$permission->id}})" class="btn btn-danger me-1" wire:loading.remove wire:target="remove({{$permission->id}})">Remove</button>
                            <button type="button" disabled class="btn btn-danger me-1" wire:loading wire:target="remove({{$permission->id}})"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        </td>
                    </tr>
                @endforeach
                {{ $permissions->links('components.general.pagination-links') /* For pagination links */}}
            @endif
            </tbody>

        </table>
    </div>

    <!-- Add Permission Modal -->
    <div class="modal fade" id="editPermissionModal" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Edit Permission</h1>
                        <p>Permissions you may use and assign to your workers.</p>
                    </div>

                    @if($editPermission)
                    @livewire('edit-company-permission-form', ['company_permission_id' => $editPermission])
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!--/ Add Permission Modal -->

</div>
