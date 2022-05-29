<div class="card">
    <div class="card-datatable table-responsive">
        <div class="card-body border-bottom">
            <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->permissions)}} @endif Permissions</h4>
            <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

            <input type="text" class="form-control" wire:model="search" placeholder="Search for permission by name"/>
            <div class="row">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>

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
                        @if($permission->type != 'default')
                            <td>
                                <a class="btn btn-primary" href="{{route('company.permission-details', $permission->id)}}" >
                                    Details
                                </a>
                            </td>
                            <td>
                                <button type="button" wire:click="remove({{$permission->id}})" class="btn btn-danger me-1" wire:loading.remove wire:target="remove({{$permission->id}})">Remove</button>
                                <button type="button" disabled class="btn btn-danger me-1" wire:loading wire:target="remove({{$permission->id}})"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
            </tbody>

        </table>
        @if(!$searchResult)
            {{ $permissions->links('components.general.pagination-links') /* For pagination links */}}
        @endif
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
