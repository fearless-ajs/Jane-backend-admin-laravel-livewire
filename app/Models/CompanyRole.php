<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRole extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permissions(){
        return $this->hasMany(CompanyPermissionRole::class, 'company_role_id');
    }

    public function rolePermissions(){
        return $this->hasMany(CompanyPermissionRole::class, 'company_role_id');
    }
}
