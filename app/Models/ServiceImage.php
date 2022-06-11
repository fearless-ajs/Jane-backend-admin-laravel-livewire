<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getServiceImageAttribute(){
        return asset("uploads/img/$this->image");
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
