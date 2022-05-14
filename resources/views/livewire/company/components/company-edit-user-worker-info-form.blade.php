<div class="modal fade current-modal" wire:ignore.self id="editUserWorkerInfoForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Other information</h1>
                    <p>Update user information.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateUser">

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-email">Phone*</label>
                        <input type="text" wire:model.lazy="phone"  class="form-control  {{$errors->has('phone')? 'is-invalid' : '' }}" placeholder="Phone number">
                        @error('phone') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-contact">Country*</label>
                        <input type="text" wire:model.lazy="country"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('country')? 'is-invalid' : '' }}" placeholder="Nationality"/>
                        @error('country') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">State*</label>
                        <input type="text" wire:model.lazy="state"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('state')? 'is-invalid' : '' }}" placeholder="State"/>
                        @error('state') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">City*</label>
                        <input type="text" wire:model.lazy="city"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('city')? 'is-invalid' : '' }}" placeholder="City"/>
                        @error('city') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-company">Address*</label>
                        <input type="text" wire:model.lazy="address"  id="basic-icon-default-contact" class="form-control dt-contact {{$errors->has('address')? 'is-invalid' : '' }}" placeholder="Address"/>
                        @error('address') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
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
