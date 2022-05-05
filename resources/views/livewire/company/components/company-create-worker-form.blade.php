<div class="modal modal-slide-in new-user-modal fade" wire:ignore.self id="modals-slide-in">
    <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" wire:submit.prevent="create">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Last Name*</label>
                    <input type="text" wire:model.lazy="lastname" class="form-control dt-full-name  {{$errors->has('lastname')? 'is-invalid' : '' }}"  placeholder="Worker's lastname"/>
                    @error('lastname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">First Name*</label>
                    <input type="text" wire:model.lazy="firstname" class="form-control dt-full-name  {{$errors->has('firstname')? 'is-invalid' : '' }}"  placeholder="Worker's firstname" />
                    @error('firstname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Email*</label>
                    <input type="text" wire:model.lazy="email"  class="form-control dt-email  {{$errors->has('email')? 'is-invalid' : '' }}" placeholder="john.doe@example.com">
                    @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Phone*</label>
                    <input type="text" wire:model.lazy="phone"  class="form-control  {{$errors->has('phone')? 'is-invalid' : '' }}" placeholder="Phone number">
                    @error('phone') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-contact">Country*</label>
                    <input type="text" wire:model.lazy="country"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('country')? 'is-invalid' : '' }}" placeholder="Nationality"/>
                    @error('country') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-company">State*</label>
                    <input type="text" wire:model.lazy="state"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('state')? 'is-invalid' : '' }}" placeholder="State"/>
                    @error('state') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-company">City*</label>
                    <input type="text" wire:model.lazy="city"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('city')? 'is-invalid' : '' }}" placeholder="City"/>
                    @error('city') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-company">Address*</label>
                    <input type="text" wire:model.lazy="address"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('address')? 'is-invalid' : '' }}" placeholder="Address"/>
                    @error('address') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <label class="form-label" for="country">Role*</label>
                    <select wire:model.lazy="role"  class="select2 form-select">
                        <option value="">Select role</option>
                        @if($roles)
                            @foreach($roles as $role)
                                 <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>

                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-company">Password*</label>
                    <input type="text" wire:model.lazy="password"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('password')? 'is-invalid' : '' }}" placeholder="Update password"/>
                    @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>

                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-company">Confirm password*</label>
                    <input type="text" wire:model.lazy="password_confirmation"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('password_confirmation')? 'is-invalid' : '' }}" placeholder="Confirm new password"/>
                    @error('password_confirmation') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>

                <button type="submit"  wire:loading.remove wire:target="create"  class="btn btn-primary me-1 data-submit">Create worker</button>
                <button type="submit"  wire:loading wire:target="create"  class="btn btn-primary me-1 data-submit"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
