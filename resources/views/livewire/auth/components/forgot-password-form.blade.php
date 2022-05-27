<form class="auth-login-form mt-2" wire:submit.prevent="sendLink">
    <div class="mb-1">
        <label for="email" class="form-label">Email</label>
        <input type="email" wire:model.lazy="email" class="form-control {{$errors->has('email')? 'is-invalid' : '' }} " placeholder="john@example.com" a />
        @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
    </div>
    <button class="btn btn-primary w-100" type="submit" wire:loading.remove wire:target="sendLink" tabindex="4">Send reset link</button>
    <button class="btn btn-primary w-100" type="button" disabled wire:loading wire:target="sendLink" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
</form>
