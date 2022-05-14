<div class="card-datatable table-responsive pt-0">
{{--    <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addContactModal">--}}
{{--        Add contact--}}
{{--    </button>--}}
    <table class="user-list-table table">
        <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Status</th>
            <th>Created_at</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($companies)
            @foreach($companies as $company)
                <tr>
                    <td>{{$company->name }}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->phone}}</td>
                    <td>{{$company->country}}</td>
                    @if($company->available)
                        <td>Active</td>
                    @else
                        <td> Unavailable</td>
                    @endif

                    <td>{{$company->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.company-profile', $company->id)}}">Profile</a> </td>
                    <td wire:loading wire:target="remove({{$company->id}})" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </td>
                    <td wire:loading.remove wire:target="remove({{$company->id}})" >
                        <i class="fa fa-trash" wire:click="remove({{$company->id}})" style="cursor: pointer"></i>
                    </td>
                    {{--                    <td>Delete</td>--}}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

