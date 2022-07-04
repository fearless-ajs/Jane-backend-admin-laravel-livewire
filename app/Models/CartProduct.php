<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class CartProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $guarded = [];

    public function catalogue(){
        return $this->hasOne(CompanyCatalogue::class,  'id', 'catalogue_id');
    }

}
