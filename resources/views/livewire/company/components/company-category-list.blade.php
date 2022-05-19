<div class="card-datatable table-responsive pt-0">
    <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add category
    </button>
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
                    <td wire:loading wire:target="remove({{$category->id}})" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </td>
                    <td wire:loading.remove wire:target="remove({{$category->id}})" >
                        <i class="fa fa-trash" wire:click="remove({{$category->id}})" style="cursor: pointer"></i>
                    </td>
                    {{--                    <td>Delete</td>--}}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

