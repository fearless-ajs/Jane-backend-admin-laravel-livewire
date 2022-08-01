<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isCataloguePresent($catalog_id){
        $catalog = CompanyCatalogue::find($catalog_id);
        if ($catalog->type == 'service'){
            if (Auth::user()->cart) {
                if (CartService::where('catalogue_id', $catalog_id)->where('cart_id', Auth::user()->cart->id)->first()){
                    return true;
                }
                return false;
            }
        }

        if ($catalog->type == 'product'){
            if (Auth::user()->cart) {
                if (CartProduct::where('catalogue_id', $catalog_id)->where('cart_id', Auth::user()->cart->id)->first()){
                    return true;
                }
                return false;
            }
        }

        return false;
    }

}
