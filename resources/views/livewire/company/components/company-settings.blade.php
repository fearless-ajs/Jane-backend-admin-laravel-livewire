<div class="content-body">
    <section class="app-user-view-account">
        <div class="row">
            <!-- User Sidebar -->
            @livewire('company-basic-info-card', ['company'  => $company])
            <!--/ User Sidebar -->

            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <ul class="nav nav-pills mb-2">
                    <li class="nav-item">
                        <a class="nav-link @if($documentsCard) active @endif" href="#" wire:click="showDocumentsCard">
                            <i class="fa fa-file font-medium-3 me-50"></i>
                            <span class="fw-bold">Documents</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($transactionCard) active @endif" href="#" wire:click="showTransactionCard">
                            <i class="fa fa-cogs font-medium-3 me-50"></i>
                            <span class="fw-bold">Banking info</span>
                        </a>
                    </li>
                </ul>

                <!-- Documents-->
                @if($documentsCard)
                    @livewire('company-documents-card', ['company' => $company])
                @endif
               <!--/ Documents -->

                <!--Banking information -->
                @if($transactionCard)
                    @livewire('company-banking-info-card', ['company' => $company])
                @endif
            <!--/ Roles and permission card -->

{{--                <!-- Security card -->--}}
{{--                @if($securityCard)--}}
{{--                    @livewire('company-worker-security-card', ['worker' => $worker])--}}
{{--            @endif--}}
{{--            <!--/ Security card -->--}}
{{--            </div>--}}


        </div>
    </section>
    <!-- Edit User Modal -->

    @livewire('company-edit-settings-form', ['company' => $company])
    <!--/ Edit User Modal -->


</div>
