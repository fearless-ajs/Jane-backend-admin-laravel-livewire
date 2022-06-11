<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getAppImageAttribute(){
        if (!empty($this->app_logo)){
            return asset("uploads/img/$this->app_logo");
        }else{
            return "https://ui-avatars.com/api/?name=$this->app_name&color=FFFFFF&background=563C5C";
        }
    }

    public function currency(){
        return $this->hasOne(Currency::class, 'id', 'app_currency');
    }

}
