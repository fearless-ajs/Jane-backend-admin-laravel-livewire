<div class="modal fade current-modal edit-company-billing-cycle-modal" wire:ignore.self id="editBillingCycleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit billing cycle</h1>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="updateCycle">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Title</label>
                        <input type="text" wire:model.lazy="title" class="form-control dt-full-name  {{$errors->has('title')? 'is-invalid' : '' }}"  placeholder="Billing cycle title" />
                        @error('title') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Cycle days</label>
                        <input type="number" wire:model.lazy="days" class="form-control dt-full-name  {{$errors->has('days')? 'is-invalid' : '' }}"  placeholder="Billing cycle days" />
                        @error('days') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="updateCycle"  class="btn btn-primary me-1">Update billing cycle</button>
                        <button type="submit"  wire:loading wire:target="updateCycle"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
