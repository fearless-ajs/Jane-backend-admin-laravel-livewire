<div class="modal fade current-modal" id="addPermissionModal" wire:ignore.self tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Add New Permission</h1>
                    <p>Set new permission</p>
                </div>
                <!-- Add role form -->
                <form  class="row" wire:submit.prevent="create">
                    <div class="col-12 mb-1">
                        <label class="form-label" for="modalRoleName">Permission Name*</label>
                        <input type="text" wire:model.lazy="name" name="modalPermissionName" class="form-control {{$errors->has('name')? 'is-invalid' : '' }}" placeholder="Enter role name" autofocus  />
                        @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="modalRoleName">Permission Description*</label>
                        <textarea wire:model.lazy="description" class="form-control {{$errors->has('description')? 'is-invalid' : '' }}" placeholder="Describe the duty of this role"></textarea>
                        @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Permission Modules*</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                <tr>
                                    <td class="text-nowrap fw-bolder">
                                        Super Administrator Access
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                                                <i data-feather="info"></i>
                                                            </span>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model="assignAllModules" type="checkbox" id="selectAll" />
                                            <label class="form-check-label" for="selectAll"> Assign all modules </label>
                                        </div>
                                    </td>
                                </tr>

                                @if($modules && !$assignAllModules)
                                    @foreach($modules as $module)
                                        <tr>
                                            <td class="text-nowrap fw-bolder">{{$module->name}}</td>
                                            <td class="text-nowrap fw-bolder">{{$module->access}}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-1">
                                                        <input class="form-check-input" value="{{$module->id}}" type="checkbox" wire:model="selectedModules" id="userManagementRead" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary" wire:loading.remove wire:target="create">Create permission</button>
                        <button type="button" disabled class="btn btn-primary" wire:loading wire:target="create"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>

