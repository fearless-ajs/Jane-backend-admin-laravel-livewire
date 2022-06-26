<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-50">Attached Permissions</h4>
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


    @if(Auth::user()->hasModuleAccess('user', 'edit') || Auth::user()->hasRole('super-admin'))
        <hr />
        <div class="table-responsive">
            <div class="modal-body">
                <form class="row" wire:submit.prevent="updatePermission">
                    <div class="col-12 col-md-12 mb-1">
                        <p class="mb-1">Assign new permission to user</p>
                        <select wire:model.lazy="permission" multiple class="select2 form-select">
                            @if($permissions)
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('permission') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="card-body">
                        <button type="submit"  wire:loading.remove wire:target="updatePermission"  class="btn btn-primary me-1">Save changes</button>
                        <button type="submit"  wire:loading wire:target="updatePermission"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
