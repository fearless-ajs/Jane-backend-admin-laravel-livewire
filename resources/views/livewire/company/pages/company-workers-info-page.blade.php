@extends('layouts.company.app')


@section('content')
    <div class="content-body">
        <section class="app-user-view-account">
            <div class="row">
                <!-- User Sidebar -->

                @livewire('company-worker-basic-info-card', ['worker'  => $worker])


                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- User Pills -->
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="app-user-view-account.html">
                                <i data-feather="user" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Account</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="app-user-view-security.html">
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

                    <!-- Project table -->
                    <div class="card">
                        <h4 class="card-header">User's Projects List</h4>
                        <div class="table-responsive">
                            <table class="table datatable-project">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Project</th>
                                    <th class="text-nowrap">Total Task</th>
                                    <th>Progress</th>
                                    <th>Hours</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /Project table -->

                    <!-- Activity Timeline -->
                    <div class="card">
                        <h4 class="card-header">User Activity Timeline</h4>
                        <div class="card-body pt-1">
                            <ul class="timeline ms-50">
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>User login</h6>
                                            <span class="timeline-event-time me-1">12 min ago</span>
                                        </div>
                                        <p>User login at 2:12pm</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Meeting with john</h6>
                                            <span class="timeline-event-time me-1">45 min ago</span>
                                        </div>
                                        <p>React Project meeting with john @10:15am</p>
                                        <div class="d-flex flex-row align-items-center mb-50">
                                            <div class="avatar me-50">
                                                <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" width="38" height="38" />
                                            </div>
                                            <div class="user-info">
                                                <h6 class="mb-0">Leona Watkins (Client)</h6>
                                                <p class="mb-0">CEO of pixinvent</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Create a new react project for client</h6>
                                            <span class="timeline-event-time me-1">2 day ago</span>
                                        </div>
                                        <p>Add files to new design folder</p>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6>Create Invoices for client</h6>
                                            <span class="timeline-event-time me-1">12 min ago</span>
                                        </div>
                                        <p class="mb-0">Create new Invoices and send to Leona Watkins</p>
                                        <div class="d-flex flex-row align-items-center mt-50">
                                            <img class="me-1" src="../../../app-assets/images/icons/pdf.png" alt="data.json" height="25" />
                                            <h6 class="mb-0">Invoices.pdf</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /Activity Timeline -->

                    <!-- Invoice table -->
                    <div class="card">
                        <table class="invoice-table table text-nowrap">
                            <thead>
                            <tr>
                                <th></th>
                                <th>#ID</th>
                                <th><i data-feather="trending-up"></i></th>
                                <th>TOTAL Paid</th>
                                <th class="text-truncate">Issued Date</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /Invoice table -->
                </div>
                <!--/ User Content -->
            </div>
        </section>
        <!-- Edit User Modal -->

        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Edit User Information</h1>
                            <p>Updating user details will receive a privacy audit.</p>
                        </div>
                        <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="Gertrude" data-msg="Please enter your first name" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Barton" data-msg="Please enter your last name" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalEditUserName">Username</label>
                                <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" value="gertrude.dev" placeholder="john.doe.007" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserEmail">Billing Email:</label>
                                <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" value="gertrude@gmail.com" placeholder="example@domain.com" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserStatus">Status</label>
                                <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select" aria-label="Default select example">
                                    <option selected>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Suspended</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="Tax-8894" value="Tax-8894" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Contact</label>
                                <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="+1 (609) 933-44-22" value="+1 (609) 933-44-22" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLanguage">Language</label>
                                <select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select" multiple>
                                    <option value="english">English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                    <option value="dutch">Dutch</option>
                                    <option value="hebrew">Hebrew</option>
                                    <option value="sanskrit">Sanskrit</option>
                                    <option value="hindi">Hindi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserCountry">Country</label>
                                <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select">
                                    <option value="">Select Value</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center mt-1">
                                    <div class="form-check form-switch form-check-primary">
                                        <input type="checkbox" class="form-check-input" id="customSwitch10" checked />
                                        <label class="form-check-label" for="customSwitch10">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                    <label class="form-check-label fw-bolder" for="customSwitch10">Use as a billing address?</label>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2 pt-50">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                    Discard
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->


    </div>
@endsection
