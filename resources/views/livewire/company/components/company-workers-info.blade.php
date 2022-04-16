<div class="content-body">
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            @livewire('company-worker-basic-info-card', ['worker'  => $worker])
            <!--/ User Sidebar -->


            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <ul class="nav nav-pills mb-2">
                    <li class="nav-item">
                        <a class="nav-link @if($rolesCard) active @endif" href="#" wire:click="showRolesCard">
                            <i class="fa fa-user font-medium-3 me-50"></i>
                            <span class="fw-bold">Roles</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($teamsCard) active @endif" href="#" wire:click="showTeamsCard">
                            <i class="fa fa-user font-medium-3 me-50"></i>
                            <span class="fw-bold">Teams</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($securityCard) active @endif" href="#" wire:click="showSecurityCard">
                            <i class="fa fa-lock font-medium-3 me-50"></i>
                            <span class="fw-bold">Security</span>
                        </a>
                    </li>
                </ul>

                <!-- Roles and permission card -->
                @if($rolesCard)
                    @livewire('company-worker-role-info-card', ['worker' => $worker])
                @endif
                <!--/ Roles and permission card -->

                <!-- Roles and permission card -->
                @if($teamsCard)
                    @livewire('company-worker-team-info-card', ['worker' => $worker])
                @endif
            <!--/ Roles and permission card -->

                <!-- Security card -->
                @if($securityCard)
                    @livewire('company-worker-security-card', ['worker' => $worker])
                @endif
                <!--/ Security card -->
            </div>


        </div>
    </section>
    <!-- Edit User Modal -->

    @livewire('company-edit-worker-form', ['worker' => $worker])
    <!--/ Edit User Modal -->


</div>
