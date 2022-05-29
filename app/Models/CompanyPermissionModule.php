<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPermissionModule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function module(){
        return $this->hasOne(CompanyModule::class, 'id','company_module_id');
    }
}
