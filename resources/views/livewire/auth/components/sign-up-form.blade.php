<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form" wire:submit.prevent="register">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="login-lastname" class="form-label">Lastname</label>
                                    <input type="text" wire:model.lazy="lastname" class="form-control  {{$errors->has('lastname')? 'is-invalid' : '' }}" id="login-lastname" placeholder="Lastname" tabindex="1" autofocus />
                                    @error('lastname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="login-firstname" class="form-label">Firstname</label>
                                    <input type="text" wire:model.lazy="firstname" class="form-control  {{$errors->has('firstname')? 'is-invalid' : '' }}" id="login-firstname" placeholder="Firstname" tabindex="1" autofocus />
                                    @error('firstname') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" wire:model.lazy="email" class="form-control {{$errors->has('email')? 'is-invalid' : '' }} " id="email" name="login-email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus />
                                    @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" wire:model.lazy="password" class="form-control form-control-merge {{$errors->has('password')? 'is-invalid' : '' }}" id="login-password"  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password_confirmation">Confirm password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" wire:model.lazy="password_confirmation" class="form-control form-control-merge {{$errors->has('password_confirmation')? 'is-invalid' : '' }}" id="login-password_confirmation" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    @error('password_confirmation') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <h4>Company info</h4>
                                <hr />
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="login-firstname" class="form-label">Company name</label>
                                    <input type="text" wire:model.lazy="company_name" class="form-control  {{$errors->has('company_name')? 'is-invalid' : '' }}" id="login-firstname" placeholder="Enter your company's fullname" tabindex="1" autofocus />
                                    @error('company_name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label for="email" class="form-label">Company email</label>
                                    <input type="company_email" wire:model.lazy="company_email" class="form-control {{$errors->has('company_email')? 'is-invalid' : '' }} " id="email" name="login-email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus />
                                    @error('company_email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12"
                            ><div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input {{$errors->has('terms')? 'is-invalid' : '' }}" wire:model.lazy="terms" type="checkbox" id="remember-me" tabindex="3" />
                                        <label class="form-check-label" for="remember-me"> I agree to <a href="#">privacy policy & terms</a> </label>
                                    </div>
                                    @error('terms') <span style="color: crimson; font-size: 10px;">You have to accept our privacy policy & terms</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary me-1" type="submit" wire:loading.remove wire:target="register" tabindex="4">Sign up</button>
                                <button class="btn btn-primary me-1" type="button" disabled wire:loading wire:target="register" tabindex="4"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

