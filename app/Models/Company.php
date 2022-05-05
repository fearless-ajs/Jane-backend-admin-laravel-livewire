<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bankingInfo(){
        return $this->hasOne(CompanyTransactionInfo::class,  'company_id');
    }
}
