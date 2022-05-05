<div>
    <form wire:submit.prevent="create" class="row" >

        <div class="col-12 mb-1">
            <label class="form-label" for="modalPermissionName">Permission Name*</label>
            <input type="text" wire:model.lazy="name" name="modalPermissionName" class="form-control {{$errors->has('name')? 'is-invalid' : '' }}" placeholder="Permission Name" autofocus data-msg="Please enter permission name" />
            @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
        </div>

        <div class="col-12">
            <label class="form-label" for="modalPermissionName">Description*</label>
            <textarea wire:model.lazy="description" class="form-control {{$errors->has('description')? 'is-invalid' : '' }}" placeholder="Describe the permission"></textarea>
            @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary mt-2 me-1" wire:loading.remove wire:target="create">Create Permission</button>
            <button type="button" disabled class="btn btn-primary mt-2 me-1" wire:loading wire:target="create"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                Discard
            </button>
        </div>
    </form>
</div>
