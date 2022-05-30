<form class="auth-login-form mt-2" wire:submit.prevent="verify">
    <div class="mb-1">
        <label for="email" class="form-label">Code</label>
        <input type="number" wire:model.lazy="code" class="form-control {{$errors->has('code')? 'is-invalid' : '' }} " placeholder="Enter the two factor code here"/>
        @error('code') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
    </div>
    <button class="btn btn-primary w-100" type="submit" wire:loading.remove wire:target="verify" tabindex="4">verify code</button>
    <button class="btn btn-primary w-100" type="button" disabled wire:loading wire:target="verify" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
</form>
