<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-50">Attached Roles</h4>
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

    @if(Route::currentRouteName() != 'admin.company-user-profile')
    <hr />
    <div class="table-responsive">
        <div class="modal-body">
            <form class="row" wire:submit.prevent="updateRole">
                <div class="col-12 col-md-12">
                    <p class="mb-1">Assign new role to worker</p>
                    <select wire:model.lazy="role" multiple  class="select2 form-select">
                        @if($roles)
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="card-body">
                    <button type="submit"  wire:loading.remove wire:target="updateRole"  class="btn btn-primary me-1">Save changes</button>
                    <button type="submit"  wire:loading wire:target="updateRole"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
    </div>
    @endif

</div>
