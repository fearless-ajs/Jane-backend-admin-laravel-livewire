<div class="card-datatable table-responsive pt-0">
    <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#addContactModal">
        Add contact
    </button>
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
        @if($contacts)
            @foreach($contacts as $contact)
                <tr>
                    <td>{{$contact->lastname. ' ' .$contact->firstname }}</td>
                    <td>{{$contact->primary_email}}</td>
                    <td>{{$contact->mobile_phone}}</td>
                    <td>{{$contact->country}}</td>
                    @if($contact->available)
                        <td>Available</td>
                    @else
                        <td> Unavailable</td>
                    @endif

                    <td>{{$contact->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('company.contacts.profile', $contact->id)}}">Details</a> </td>
                    <td wire:loading wire:target="remove({{$contact->id}})" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </td>
                    <td wire:loading.remove wire:target="remove({{$contact->id}})" >
                        <i class="fa fa-trash" wire:click="remove({{$contact->id}})" style="cursor: pointer"></i>
                    </td>
{{--                    <td>Delete</td>--}}
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

