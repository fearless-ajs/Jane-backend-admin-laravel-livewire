<div class="row">
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->roles)}} @endif Roles</h4>
        <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

        <input type="text" class="form-control" wire:model="search" placeholder="Search for role by name"/>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>
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
                        <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                            <span class="btn btn-primary mb-1">Add New Role</span>
                        </a>
                        <p class="mb-0">Add role, if it does not exist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if($roles)
        @foreach($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{$role->display_name}}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                    <small class="fw-bolder">{{$role->description}}</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" wire:click="remove({{$role->id}})" class="text-body"><i data-feather="copy" class="font-medium-5"></i>
                                <span wire:loading wire:target="remove({{$role->id}})" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span wire:loading.remove wire:target="remove({{$role->id}})">Remove</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @if(!$searchResult)
                {{ $roles->links('components.general.pagination-links') /* For pagination links */}}
            @endif
    @endif


    <!-- Edit Role Modal -->
    @livewire('company-edit-role-form')
    <!--/ Edit Role Modal -->
</div>
