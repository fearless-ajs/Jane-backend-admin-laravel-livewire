<?php

namespace App\Http\Livewire;

use App\Models\CompanyRole;
use App\Models\CompanyRoleUser;
use App\Models\CompanyTeam;
use App\Models\CompanyTeamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyWorkerTeamInfoCard extends Component
{

    public $worker;

    // Selected roles
    public $role=[];
    public $team=[];

    // database roles
    public $roles;
    public $teams;

    protected $listeners = ['refreshWorkerTeam' => '$refresh'];

    public function mount($worker)
    {
        $this->worker = $worker;
        $this->fetchData();
    }


    public function updateTeam(){
        $this->validate([
            'team'                  => 'array',
        ]);


        // Check if new teams is supplied
        if(count($this->team) > 0){
            // Check if the team exist first then ignore
            foreach ($this->team as $team){
                if (!CompanyTeamUser::where('user_id', $this->worker->user_id)
                    ->where('company_team_id', $team)
                    ->where('company_id', Auth::user()->company_id)->first())
                {
                    CompanyTeamUser::create([
                        'company_id'        => Auth::user()->company_id,
                        'user_id'           => $this->worker->user_id,
                        'company_team_id'   => $team,
                    ]);
                }else{
                    return $this->emit('alert', ['type' => 'info', 'message' => 'Worker already belongs to the team']);
                }
            }
        }

        $this->emit('refreshWorkerTeam');
        $this->emit('refreshWorkerBasicInfoCard');
        $this->resetExcept(['teams', 'worker']);
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker added to team']);
    }

    public function fetchData(){
        $this->roles  = CompanyRole::where('company_id', Auth::user()->company_id)->get();
        $this->teams  = CompanyTeam::where('company_id', Auth::user()->company_id)->get();
    }

    public function detachTeam($team_id){
        CompanyTeamUser::where('id', $team_id)->delete();
        $this->emit('refreshWorkerTeam');
        $this->emit('refreshWorkerBasicInfoCard');
        return $this->emit('alert', ['type' => 'success', 'message' => 'Worker removed from team']);
    }

    public function render()
    {
        return view('livewire.company.components.company-worker-team-info-card');
    }
}
