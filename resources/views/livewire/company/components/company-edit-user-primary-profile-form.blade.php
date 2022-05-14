<div class="modal fade current-modal" wire:ignore.self id="editUserPrimaryProfileForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Update primary profile</h1>
                    <p>Update user information.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateUser">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">lastname*</label>
                        <input type="text" wire:model.lazy="lastname" class="form-control dt-full-name  {{$errors->has('lastname')? 'is-invalid' : '' }}"  placeholder="Lastname" />
                        @error('lastname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">firstname*</label>
                        <input type="text" wire:model.lazy="firstname" class="form-control dt-full-name  {{$errors->has('first')? 'is-invalid' : '' }}"  placeholder="Firstname" />
                        @error('firstname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Email*</label>
                        <input type="email" wire:model.lazy="email"  class="form-control dt-email  {{$errors->has('email')? 'is-invalid' : '' }}" placeholder="Your email" >
                        @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Image</label>
                        <input type="file" wire:model.lazy="image"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('image')? 'is-invalid' : '' }}"/>
                        @error('image') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="updateUser"  class="btn btn-primary me-1">update profile</button>
                        <button type="submit"  wire:loading wire:target="updateUser"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
