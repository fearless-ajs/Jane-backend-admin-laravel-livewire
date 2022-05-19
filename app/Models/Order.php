<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products(){
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function services(){
        return $this->hasMany(OrderService::class, 'order_id');
    }
}
