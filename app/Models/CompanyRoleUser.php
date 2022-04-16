<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRoleUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function role(){
        return $this->belongsTo(CompanyRole::class, 'company_role_id');
    }
}
