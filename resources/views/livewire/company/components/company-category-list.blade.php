<div class="card-datatable table-responsive pt-0">
    @if(Auth::user()->hasModuleAccess('category', 'create'))
        <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Add category
        </button>
    @endif
    <div class="card-body border-bottom">
        <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->categories)}} @endif Categories</h4>
        <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

        <input type="text" class="form-control" wire:model="search" placeholder="Search for category by name"/>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>

    <table class="user-list-table table">
        <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Created_at</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($categories)
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name }}</td>

                    <td>{{$category->created_at->diffForHumans()}}</td>
                    @if(Auth::user()->hasModuleAccess('invoice', 'delete'))
                    <td wire:loading wire:target="remove({{$category->id}})" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </td>
                    <td wire:loading.remove wire:target="remove({{$category->id}})" >
                        <i class="fa fa-trash" wire:click="remove({{$category->id}})" style="cursor: pointer"></i>
                    </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!$searchResult)
        {{ $categories->links('components.general.pagination-links') /* For pagination links */}}
    @endif
</div>

