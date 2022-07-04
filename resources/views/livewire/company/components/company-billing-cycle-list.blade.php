<div class="card-datatable table-responsive pt-0">
    @if(Auth::user()->hasModuleAccess('billing-cycle', 'create') || Auth::user()->hasRole('super-admin'))
        <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addBillingCycleModal">
            Add billing cycle
        </button>
    @endif
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->billingCycles)}} @endif Billing cycles</h4>
        <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

        <input type="text" class="form-control" wire:model="search" placeholder="Search for billing cycle by title"/>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>

    <table class="user-list-table table">
        <thead class="table-light">
        <tr>
            <th>Title</th>
            <th>Days</th>
            <th>Created_at</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($cycles)
            @foreach($cycles as $cycle)
                <tr>
                    <td>{{$cycle->title }}</td>
                    <td>{{$cycle->days }}</td>
                    <td>{{$cycle->created_at->diffForHumans()}}</td>

                    @if(Auth::user()->hasModuleAccess('billing-cycle', 'edit') || Auth::user()->hasRole('super-admin'))
                    <td><a href="#" wire:click="edit({{$cycle->id}})" >Edit</a> </td>
                    @endif

                    @if(Auth::user()->hasModuleAccess('billing-cycle', 'delete') || Auth::user()->hasRole('super-admin'))
                        <td wire:loading wire:target="remove({{$cycle->id}})" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                        <td wire:loading.remove wire:target="remove({{$cycle->id}})" >
                            <i class="fa fa-trash" wire:click="remove({{$cycle->id}})" style="cursor: pointer"></i>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!$searchResult)
        {{ $cycles->links('components.general.pagination-links') /* For pagination links */}}
    @endif

        @if(Auth::user()->hasModuleAccess('billing-cycle', 'edit') || Auth::user()->hasRole('super-admin'))
            @livewire('company-edit-billing-cycle-form', ['company' => $company])
        @endif

</div>

