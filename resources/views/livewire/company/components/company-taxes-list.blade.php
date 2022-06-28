<div class="card-datatable table-responsive pt-0">
    @if(Auth::user()->hasModuleAccess('category', 'create') || Auth::user()->hasRole('super-admin'))
        <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addTaxModal">
            Add tax
        </button>
    @endif
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->taxes)}} @endif Taxes</h4>
        <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

        <input type="text" class="form-control" wire:model="search" placeholder="Search for tax by title"/>
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
            <th>Percentage</th>
            <th>Created_at</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($taxes)
            @foreach($taxes as $tax)
                <tr>
                    <td>{{$tax->title }}</td>
                    <td>{{$tax->percentage }}</td>
                    <td>{{$tax->created_at->diffForHumans()}}</td>
                    <td><a href="#" wire:click="edit({{$tax->id}})" >Edit</a> </td>
                    @if(Auth::user()->hasModuleAccess('invoice', 'delete') || Auth::user()->hasRole('super-admin'))
                        <td wire:loading wire:target="remove({{$tax->id}})" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                        <td wire:loading.remove wire:target="remove({{$tax->id}})" >
                            <i class="fa fa-trash" wire:click="remove({{$tax->id}})" style="cursor: pointer"></i>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!$searchResult)
        {{ $taxes->links('components.general.pagination-links') /* For pagination links */}}
    @endif

    @livewire('company-edit-tax-form', ['company', $company])
</div>

