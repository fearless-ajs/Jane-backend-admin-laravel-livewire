<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveService extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function catalogue(){
        return $this->belongsTo(CompanyCatalogue::class, 'catalogue_id');
    }

}
