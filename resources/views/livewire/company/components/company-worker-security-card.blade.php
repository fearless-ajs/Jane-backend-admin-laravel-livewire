<div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Pills -->
    <ul class="nav nav-pills mb-2">
        <li class="nav-item">
            <a class="nav-link" href="app-user-view-account.html">
                <i data-feather="user" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Account</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="app-user-view-security.html">
                <i data-feather="lock" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Security</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="app-user-view-billing.html">
                <i data-feather="bookmark" class="font-medium-3 me-50"></i>
                <span class="fw-bold">Billing & Plans</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="app-user-view-notifications.html">
                <i data-feather="bell" class="font-medium-3 me-50"></i><span class="fw-bold">Notifications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="app-user-view-connections.html">
                <i data-feather="link" class="font-medium-3 me-50"></i><span class="fw-bold">Connections</span>
            </a>
        </li>
    </ul>
    <!--/ User Pills -->

    <!-- Change Password -->
    <div class="card">
        <h4 class="card-header">Change Password</h4>
        <div class="card-body">
            <form id="formChangePassword" method="POST" onsubmit="return false">
                <div class="alert alert-warning mb-2" role="alert">
                    <h6 class="alert-heading">Ensure that these requirements are met</h6>
                    <div class="alert-body fw-normal">Minimum 8 characters long, uppercase & symbol</div>
                </div>

                <div class="row">
                    <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </span>
                        </div>
                    </div>

                    <div class="mb-2 col-md-6 form-password-toggle">
                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary me-2">Change Password</button>
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

    <!-- recent device -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Recent devices</h4>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap text-center">
                <thead>
                <tr>
                    <th class="text-start">BROWSER</th>
                    <th>DEVICE</th>
                    <th>LOCATION</th>
                    <th>RECENT ACTIVITY</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-start">
                        <div class="avatar me-25">
                            <img src="../../../app-assets/images/icons/google-chrome.png" alt="avatar" width="20" height="20" />
                        </div>
                        <span class="fw-bolder">Chrome on Windows</span>
                    </td>
                    <td>Dell XPS 15</td>
                    <td>United States</td>
                    <td>10, Jan 2021 20:07</td>
                </tr>
                <tr>
                    <td class="text-start">
                        <div class="avatar me-25">
                            <img src="../../../app-assets/images/icons/google-chrome.png" alt="avatar" width="20" height="20" />
                        </div>
                        <span class="fw-bolder">Chrome on Android</span>
                    </td>
                    <td>Google Pixel 3a</td>
                    <td>Ghana</td>
                    <td>11, Jan 2021 10:16</td>
                </tr>
                <tr>
                    <td class="text-start">
                        <div class="avatar me-25">
                            <img src="../../../app-assets/images/icons/google-chrome.png" alt="avatar" width="20" height="20" />
                        </div>
                        <span class="fw-bolder">Chrome on MacOS</span>
                    </td>
                    <td>Apple iMac</td>
                    <td>Mayotte</td>
                    <td>11, Jan 2021 12:10</td>
                </tr>
                <tr>
                    <td class="text-start">
                        <div class="avatar me-25">
                            <img src="../../../app-assets/images/icons/google-chrome.png" alt="avatar" width="20" height="20" />
                        </div>
                        <span class="fw-bolder">Chrome on iPhone</span>
                    </td>
                    <td>Apple iPhone XR</td>
                    <td>Mauritania</td>
                    <td>12, Jan 2021 8:29</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- / recent device -->
</div>
