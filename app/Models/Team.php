<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $guarded = [];
}
