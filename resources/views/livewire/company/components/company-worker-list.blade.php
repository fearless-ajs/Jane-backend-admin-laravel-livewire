

<div class="card">
    <div class="card-body border-bottom">
        <h4 class="card-title">Search</h4>
        <div class="row">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div>
    </div>



    <div class="card-datatable table-responsive pt-0">
        <div class="card-body border-bottom">
            <h4 wire:loading.remove wire:target="search" class="card-title">@if($searchResult)  {{count($searchResult)}}  @else {{count($company->users)}} @endif Users</h4>
            <h4 wire:loading wire:target="search" class="card-title">Searching... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></h4>

            <input type="text" class="form-control" wire:model="search" placeholder="Search for user by phone"/>
            <div class="row">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <button type="button" class="btn btn-primary mb-1 mt-1" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
            Add user
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
            @if($workers)
                @foreach($workers as $worker)
                    <tr>
                        <td>{{$worker->user->lastname. ' ' .$worker->user->firstname }}</td>
                        <td>{{$worker->user->email}}</td>
                        <td>{{$worker->phone}}</td>
                        <td>{{$worker->country}}</td>
                        <td>{{$worker->available}}</td>
                        <td>{{$worker->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('company.workers.profile', $worker->id)}}">Profile</a> </td>
                        <td>Delete</td>

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        @if(!$searchResult)
            {{ $workers->links('components.general.pagination-links') /* For pagination links */}}
        @endif
    </div>
</div>


