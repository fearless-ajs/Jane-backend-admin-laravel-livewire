<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function products(){
        return $this->hasMany(CartProduct::class, 'cart_id');
    }

    public function services(){
        return $this->hasMany(CartService::class, 'cart_id');
    }
}
