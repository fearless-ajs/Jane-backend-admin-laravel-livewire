<div class="modal fade current-modal" wire:ignore.self id="addTaxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add tax</h1>
                    <p>Add new tax to your company.</p>
                </div>
                <form class="row gy-1 pt-75" wire:submit.prevent="addPercentage">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Title</label>
                        <input type="text" wire:model.lazy="title" class="form-control dt-full-name  {{$errors->has('title')? 'is-invalid' : '' }}"  placeholder="Tax title" />
                        @error('title') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="basic-icon-default-fullname">Percentage</label>
                        <input type="text" wire:model.lazy="percentage" class="form-control dt-full-name  {{$errors->has('percentage')? 'is-invalid' : '' }}"  placeholder="Tax percentage value" />
                        @error('percentage') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"  wire:loading.remove wire:target="addPercentage"  class="btn btn-primary me-1">Add tax</button>
                        <button type="submit"  wire:loading wire:target="addPercentage"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
