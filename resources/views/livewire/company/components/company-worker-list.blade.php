<div class="card-datatable table-responsive pt-0">
    <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
        Add worker
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
        </tr>
        </thead>
        <tbody>
        @if($workers)
            @foreach($workers as $worker)
            <tr>
                <td>{{$worker->user->lastname. ' ' .$worker->user->firstname }}</td>
                <td>{{$worker->user->email}}</td>
                <td>{{$worker->phone}}</td>
                <td>{{$worker->country}}</td>
                <td>{{$worker->available}}</td>
                <td>{{$worker->created_at->diffForHumans()}}</td>
                <td><a href="{{route('Company.workers.profile', $worker->id)}}">Profile</a> </td>
                <td>Delete</td>

            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>

