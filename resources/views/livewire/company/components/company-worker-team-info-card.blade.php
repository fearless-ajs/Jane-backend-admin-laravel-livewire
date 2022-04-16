<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-50">Attached Teams</h4>
        <p class="mb-0">Change the teams, the worker will get the update</p>
    </div>
    <div class="table-responsive">
        <table class="table text-nowrap text-center border-bottom">
            <thead>
            <tr>
                <th class="text-start">Team Name</th>
                <th>✉️ Description</th>
                <th>🖥 Date Assigned</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if($worker->user->userTeams)
                @foreach($worker->user->userTeams as $team)
                    <tr>
                        <td class="text-start">{{$team->team->display_name}}</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <small>{{ Str::limit($team->team->description, 55, $end='...') }}</small>
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                                <p>{{$team->created_at->diffForHumans()}}</p>
                            </div>
                        </td>
                        <td wire:loading wire:target="detachTeam({{$team->id}})" >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </td>
                        <td wire:loading.remove wire:target="detachTeam({{$team->id}})" >
                            <i class="fa fa-trash" wire:click="detachTeam({{$team->id}})" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>


    <hr />
    <div class="table-responsive">
        <div class="modal-body">
            <form class="row" wire:submit.prevent="updateTeam">
                <div class="col-12 col-md-12 mb-1">
                    <p class="mb-1">Assign new team to worker</p>
                    <select wire:model.lazy="team" multiple class="select2 form-select">
                        @if($teams)
                            @foreach($teams as $team)
                                <option value="{{$team->id}}">{{$team->display_name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('team') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="card-body">
                    <button type="submit"  wire:loading.remove wire:target="updateTeam"  class="btn btn-primary me-1">Save changes</button>
                    <button type="submit"  wire:loading wire:target="updateTeam"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
    </div>

</div>
