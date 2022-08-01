<div>

    @if(!$unverifiedAccount)

        @if(session()->has('data'))
            <label class="text-center mt-2"> Didn't receive the verification email
                <a href="#" wire:click="resendLinkWithSessionData"  wire:loading.remove wire:target="resendLinkWithSessionData">click here</a>
                <a href="#" wire:loading wire:target="resendLinkWithSessionData"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></a> to resend
            </label>
        @endif

    <form class="auth-login-form mt-2" wire:submit.prevent="login">
        <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" wire:model.lazy="email" class="form-control {{$errors->has('email')? 'is-invalid' : '' }} " id="email" name="login-email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus />
            @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
        </div>

        <div class="mb-1">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">Password</label>
                <a href="{{route('forgot-password')}}">
                    <small>Forgot Password?</small>
                </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
                <input type="password" wire:model.lazy="password" class="form-control form-control-merge {{$errors->has('password')? 'is-invalid' : '' }}" id="login-password"  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
            @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
        </div>
        <div class="mb-1">
            <div class="form-check">
                <input class="form-check-input" wire:model.lazy="remember"  type="checkbox" value="1" id="remember-me" tabindex="3" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
        </div>
        <button class="btn btn-primary w-100" type="submit" wire:loading.remove wire:target="login" tabindex="4">Sign in</button>
        <button class="btn btn-primary w-100" type="button" disabled wire:loading wire:target="login" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

    </form>

    @else
        <hr />
        <form class="auth-login-form mt-2">

            <div class="mb-1 text-center text-info">
                <label for="email" class="form-label text-success" style="font-size: 95%">It seems your account is unverified, would you like us to resend the verification link?</label>
            </div>

            <button class="btn btn-primary w-100" type="button" wire:loading.remove wire:target="resendLink" wire:click="resendLink" tabindex="4">Resend verification link</button>
            <button class="btn btn-primary w-100" type="button" disabled wire:loading wire:target="resendLink" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

        </form>
    @endif





</div>

