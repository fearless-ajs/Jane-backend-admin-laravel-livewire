<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getProductImageAttribute(){
        return asset("uploads/img/$this->image");
    }

    public function ratings(){
        return $this->hasMany(ProductRating::class, 'product_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
