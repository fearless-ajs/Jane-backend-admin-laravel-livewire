<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <div class="card">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mt-3 mb-2" src="{{$company->CompanyBanner}}"  alt="User avatar" />
                    <div class="user-info text-center">
                        <h4>{{$company->name}}</h4>
                        <span class="badge bg-light-secondary">{{$company->email}}</span>
                    </div>
                    <div class="user-info text-center mt-1" style="max-width: 100%;">
                        <span class="bg-light-secondary"  style="max-width: 100%">{{$company->address}}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around my-2 pt-75">
                <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i class="fa fa-users font-medium-2"></i>
                                            </span>
                    <div class="ms-75">
                        <h4 class="mb-0">{{count($company->contacts)}}</h4>
                        <small>Contacts</small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i  class="fa fa-users font-medium-2"></i>
                                            </span>
                    <div class="ms-75">
                        <h4 class="mb-0">{{count($company->users)}}</h4>
                        <small>Users</small>
                    </div>
                </div>
            </div>
            <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Phone:</span>
                        <span>{{$company->phone}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25"> Email:</span>
                        <span>{{$company->email}}</span>
                    </li>
                    <li class="mb-75">
                        @if($company->available == 1)
                            <span class="fw-bolder me-25">Status:</span>
                            <span class="badge bg-light-success">Active</span>
                        @endif
                        @if($company->available == 0)
                            <span class="fw-bolder me-25">Status:</span>
                            <span class="badge bg-light-danger">Inactive</span>
                        @endif
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">City:</span>
                        <span>{{$company->city}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">State:</span>
                        <span>{{$company->state}}</span>
                    </li>
                    <li class="mb-75">
                        <span class="fw-bolder me-25">Country:</span>
                        <span>{{$company->country}}</span>
                    </li>
                </ul>
                <div class="d-flex justify-content-center pt-2">
                    <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editCompanySettings" data-bs-toggle="modal">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
