<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPermissionRole extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permission(){
        return $this->hasOne(CompanyPermission::class, 'id','company_permission_id');
    }

}
