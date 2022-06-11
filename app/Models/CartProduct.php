<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class, 'product_id');
    }
}
