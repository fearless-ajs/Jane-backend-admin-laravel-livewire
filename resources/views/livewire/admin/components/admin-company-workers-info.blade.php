<div class="content-body">
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            @livewire('company-worker-basic-info-card', ['worker'  => $worker])
            <!--/ User Sidebar -->


            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <ul class="nav nav-pills mb-2">
                    <li class="nav-item">
                        <a class="nav-link @if($rolesCard) active @endif" href="#" wire:click="showRolesCard">
                            <i class="fa fa-user font-medium-3 me-50"></i>
                            <span class="fw-bold">Roles</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($teamsCard) active @endif" href="#" wire:click="showTeamsCard">
                            <i class="fa fa-user font-medium-3 me-50"></i>
                            <span class="fw-bold">Permissions</span></a>
                    </li>
                </ul>

                <!-- Roles and permission card -->
                @if($rolesCard)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-50">Attached Roles ({{count($worker->user->userRoles)}})</h4>
                            <p class="mb-0">Change the roles, the worker will get the update</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap text-center border-bottom">
                                <thead>
                                <tr>
                                    <th class="text-start">Role Name</th>
                                    <th>✉️ Description</th>
                                    <th>🖥 Date Assigned</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($worker->user->userRoles)
                                    @foreach($worker->user->userRoles as $role)
                                        <tr>
                                            <td class="text-start">{{$role->role->display_name}}</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <small>{{ Str::limit($role->role->description, 55, $end='...') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <p>{{$role->created_at->diffForHumans()}}</p>
                                                </div>
                                            </td>
                                            <td wire:loading wire:target="detachRole({{$role->id}})" >
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </td>
                                            <td wire:loading.remove wire:target="detachRole({{$role->id}})" >
                                                <i class="fa fa-trash" wire:click="detachRole({{$role->id}})" style="cursor: pointer"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>

                @endif
            <!--/ Roles and permission card -->

                <!-- Roles and permission card -->
                @if($teamsCard)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-50">Attached Permissions ({{count($worker->user->userPermissions)}})</h4>
                            <p class="mb-0">Change the permissions, the user will get the updae</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap text-center border-bottom">
                                <thead>
                                <tr>
                                    <th class="text-start">Permission</th>
                                    <th>✉️ Description</th>
                                    <th>🖥 Date Assigned</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($worker->user->userPermissions)
                                    @foreach($worker->user->userPermissions as $permission)
                                        <tr>
                                            <td class="text-start">{{$permission->permission->display_name}}</td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <small>{{ Str::limit($permission->permission->description, 55, $end='...') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <p>{{$permission->created_at->diffForHumans()}}</p>
                                                </div>
                                            </td>
                                            <td wire:loading wire:target="detachPermission({{$permission->id}})" >
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </td>
                                            <td wire:loading.remove wire:target="detachPermission({{$permission->id}})" >
                                                <i class="fa fa-trash" wire:click="detachPermission({{$permission->id}})" style="cursor: pointer"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif
            <!--/ Roles and permission card -->

            <!--/ Security card -->
            </div>


        </div>
    </section>
    <!-- Edit User Modal -->

    @livewire('company-edit-worker-form', ['worker' => $worker])
    <!--/ Edit User Modal -->


</div>
