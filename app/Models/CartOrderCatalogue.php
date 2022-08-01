<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartOrderCatalogue extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function catalogue(){
        return $this->hasOne(CompanyCatalogue::class, 'id','catalogue_id');
    }

    public function cartOrder(){
        return $this->belongsTo(CartOrder::class, 'cart_order_id');
    }
}
