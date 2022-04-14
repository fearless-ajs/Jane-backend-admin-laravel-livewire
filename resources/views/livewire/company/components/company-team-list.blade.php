<div class="row">
    @if($teams)
        @foreach($teams as $team)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 3 workers</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../../app-assets/images/avatars/3.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../../app-assets/images/avatars/9.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../../app-assets/images/avatars/12.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../../app-assets/images/avatars/10.png" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../../app-assets/images/avatars/11.png" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{$team->display_name}}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <small class="fw-bolder">Edit Team</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" wire:click="remove({{$team->id}})" class="text-body"><i data-feather="copy" class="font-medium-5"></i>
                                <span wire:loading wire:target="remove({{$team->id}})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span wire:loading.remove wire:target="remove({{$team->id}})">Remove</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="row">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end justify-content-center h-100">
                        <img src="../../../app-assets/images/illustration/faq-illustrations.svg" class="img-fluid mt-2" alt="Image" width="85" />
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card-body text-sm-end text-center ps-sm-0">
                        <a href="javascript:void(0)" data-bs-target="#addTeamModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                            <span class="btn btn-primary mb-1">Add New team</span>
                        </a>
                        <p class="mb-0">Add team, if it does not exist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Role Modal -->
    @livewire('company-edit-role-form')
    <!--/ Edit Role Modal -->
</div>
