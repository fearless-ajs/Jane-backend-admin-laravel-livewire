<?php

namespace App\Http\Livewire;

use App\Models\CompanyPermissionRole;
use App\Models\CompanyPermissionTeam;
use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyTeamList extends Component
{
    use WithPagination;
    protected $listeners = ['refreshCompanyTeams' => '$refresh'];

    public function remove($team_id)
    {
        // Remove role permissions
        CompanyPermissionTeam::where('company_id', Auth::user()->company_id)->where('company_team_id', $team_id)->delete();
        // Remove role users
        CompanyTeamUser::where('company_id', Auth::user()->company_id)->where('company_team_id', $team_id)->delete();
        // Finally remove the role
        CompanyTeam::find($team_id)->delete();
        // Refresh the list
        $this->emit('refreshCompanyTeams');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Team deleted']);
    }

    public function render()
    {
        return view('livewire.Company.components.Company-team-list', [
            'teams' => CompanyTeam::where('company_id', Auth::user()->company_id)->paginate(100)
        ]);
    }
}
