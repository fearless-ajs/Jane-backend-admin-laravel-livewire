<div class="card">
    <div class="card-datatable table-responsive">
        <table class="datatables-permissions table">
            <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Created Date</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @if($permissions)
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->display_name}}</td>
                        <td>{{$permission->description}}</td>
                        <td>{{$permission->created_at->diffForHumans()}}</td>
                        <td>Edit</td>
                        <td>
                            <button type="button" wire:click="remove({{$permission->id}})" class="btn btn-danger mt-2 me-1" wire:loading.remove wire:target="remove({{$permission->id}})">Remove</button>
                            <button type="button" disabled class="btn btn-danger mt-2 me-1" wire:loading wire:target="remove({{$permission->id}})"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                        </td>
                    </tr>
                @endforeach
                {{ $permissions->links('components.general.pagination-links') /* For pagination links */}}
            @endif
            </tbody>

        </table>
    </div>
</div>
