<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function products(){
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function services(){
        return $this->hasMany(OrderService::class, 'order_id');
    }
}
