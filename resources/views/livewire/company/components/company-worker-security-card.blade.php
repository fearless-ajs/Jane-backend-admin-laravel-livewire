<div>
    <!-- Change Password -->
    <div class="card">
        <h4 class="card-header">Change Password</h4>
        <div class="card-body">
            <form wire:submit.prevent="updatePassword">
                <div class="alert alert-warning mb-2" role="alert">
                    <h6 class="alert-heading">Ensure that these requirements are met</h6>
                    <div class="alert-body fw-normal">Minimum 6 characters long, uppercase & symbol</div>
                </div>

                <div class="row">
                    <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" wire:model.lazy="password" class="form-control dt-full-name  {{$errors->has('password')? 'is-invalid' : '' }}"  placeholder="New password"/>
                        </div>
                        @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" wire:model.lazy="password_confirmation" class="form-control dt-full-name  {{$errors->has('password_confirmation')? 'is-invalid' : '' }}"  placeholder="Confirm password" />
                        </div>
                        @error('password_confirmation') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <button type="submit"  wire:loading.remove wire:target="updatePassword"  class="btn btn-primary me-2">Change Password</button>
                        <button type="submit"  wire:loading wire:target="updatePassword"  class="btn btn-primary me-2"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Change Password -->

    <!-- Two-steps verification -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-50">Two-steps verification</h4>
            <span>Keep your account secure with authentication step.</span>
            <h6 class="fw-bolder mt-2">SMS</h6>
            <div class="d-flex justify-content-between border-bottom mb-1 pb-1">
                <span>+1(968) 945-8832</span>
                <div class="action-icons">
                    <a href="javascript:void(0)" class="text-body me-50" data-bs-target="#twoFactorAuthModal" data-bs-toggle="modal">
                        <i data-feather="edit" class="font-medium-3"></i>
                    </a>
                    <a href="javascript:void(0)" class="text-body"><i data-feather="trash" class="font-medium-3"></i></a>
                </div>
            </div>
            <p class="mb-0">
                Two-factor authentication adds an additional layer of security to your account by requiring more than just a
                password to log in.
                <a href="javascript:void(0);" class="text-body">Learn more.</a>
            </p>
        </div>
    </div>
    <!--/ Two-steps verification -->

</div>
