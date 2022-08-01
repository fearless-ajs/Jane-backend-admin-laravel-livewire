<div>
    @if($showSuccessModal)
        <div class="card-body">
            <h2 class="mb-1 text-center text-primary font-large-1 mb-2">{{$settings->app_name}}</h2>
            <a href="{{route('login')}}" class="brand-logo">
                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                    <defs>
                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                            <stop stop-color="#000000" offset="0%"></stop>
                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                        </lineargradient>
                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                        </lineargradient>
                    </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                <img src="{{$settings->AppImage}}" style="max-width: 10%; margin-right: -10px" />
                            </g>
                        </g>
                    </g>
                </svg>
                <h2 class="brand-text text-primary ms-1">{{$settings->app_name}}</h2>
            </a>

            <h2 class="card-title fw-bolder mb-1">Password reset successful</h2>
            <p class="card-text mb-2">
                We have successfully reset your password, please proceed to login with your new password
            </p>

            <a href="{{route('login')}}" class="btn btn-primary w-100">Proceed to login</a>

        </div>
    @else
        <div class="card-body">
            <a href="index.html" class="brand-logo">
                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="28">
                    <defs>
                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                            <stop stop-color="#000000" offset="0%"></stop>
                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                        </lineargradient>
                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                        </lineargradient>
                    </defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                <img src="{{$settings->AppImage}}" style="max-width: 10%; margin-right: -10px" />
                            </g>
                        </g>
                    </g>
                </svg>
                <h2 class="brand-text text-primary ms-1 mb-0">{{$settings->app_name}}</h2>
            </a>
            <h4 class="card-title mb-1 text-center">Reset Password 🔒</h4>
            <p class="card-text mb-2 text-center">Your new password must be different from previously used passwords</p>

            <form class="auth-login-form mt-2" wire:submit.prevent="setPassword">

                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="login-password">Password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" wire:model="password" class="form-control form-control-merge {{$errors->has('password')? 'is-invalid' : '' }}" id="login-password"  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                    @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>

                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="login-password_confirmation">Confirm password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input type="password" wire:model="password_confirmation" class="form-control form-control-merge {{$errors->has('password_confirmation')? 'is-invalid' : '' }}" id="login-password_confirmation" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                    @error('password_confirmation') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>

                <button class="btn btn-primary w-100" type="submit" wire:loading.remove wire:target="setPassword" tabindex="4">Set New Password</button>
                <button class="btn btn-primary w-100" type="button" disabled wire:loading wire:target="setPassword" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>

            </form>


            <p class="text-center mt-2">
                <a href="{{route('sign-in')}}">
                    <span>Back to login</span>
                </a>
            </p>

        </div>
    @endif
</div>



