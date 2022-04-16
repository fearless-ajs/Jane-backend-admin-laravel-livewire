<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTeamUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function team(){
        return $this->belongsTo(CompanyTeam::class, 'company_team_id');
    }
}
