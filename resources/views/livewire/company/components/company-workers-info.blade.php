<div class="content-body">
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            @livewire('company-worker-basic-info-card', ['worker'  => $worker])
            <!--/ User Sidebar -->

            <!-- Roles and permission card -->
            @if($rolesAndPermissionCard)
            @livewire('company-worker-role-permission-info-card', ['worker' => $worker])
            @endif
            <!--/ Roles and permission card -->



        </div>
    </section>
    <!-- Edit User Modal -->

    @livewire('company-edit-worker-form', ['worker' => $worker])
    <!--/ Edit User Modal -->


</div>
