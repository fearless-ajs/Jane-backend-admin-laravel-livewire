<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <div class="card">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mt-3 mb-2" src="../../../app-assets/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar" />
                    <div class="user-info text-center">
                        <h4>{{$worker->user->lastname. '  ' .$worker->user->firstname }}</h4>
                        <span class="badge bg-light-secondary">{{$worker->user->email}}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around my-2 pt-75">
                <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="check" class="font-medium-2"></i>
                                            </span>
                    <div class="ms-75">
                        <h4 class="mb-0">3</h4>
                        <small>Team member</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="briefcase" class="font-medium-2"></i>
                                            </span>
                    <div class="ms-75">
                        <h4 class="mb-0">4</h4>
                        <small>Assigned roles</small>
                    </div>
                </div>
            </div>
            <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Phone:</span>
                        <span>{{$worker->phone}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25"> Email:</span>
                        <span>{{$worker->user->email}}</span>
                    </li>
                    <li class="mb-75">
                        @if($worker->available == 1)
                            <span class="fw-bolder me-25">Status:</span>
                            <span class="badge bg-light-success">Active</span>
                        @endif
                        @if($worker->available == 0)
                             <span class="fw-bolder me-25">Status:</span>
                             <span class="badge bg-light-danger">Inactive</span>
                        @endif
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Roles:</span>
                        @if($worker->user->userRoles)
                            @foreach($worker->user->userRoles as $role)
                                <span>{{$role->role}}</span>
                            @endforeach
                        @endif

                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">City:</span>
                        <span>{{$worker->city}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">State:</span>
                        <span>{{$worker->state}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Country:</span>
                        <span>{{$worker->country}}</span>
                    </li>
                </ul>
                <div class="d-flex justify-content-center pt-2">
                    <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                        Edit
                    </a>
                    <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>
                </div>
            </div>
        </div>
    </div>
</div>
