<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function service(){
        return $this->hasOne(Service::class, 'id','service_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class, 'id','contact_id');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'id','company_id');
    }

}
