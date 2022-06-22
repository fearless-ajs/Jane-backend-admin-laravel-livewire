<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCatalogue extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function ratings(){
        return $this->hasMany(ProductRating::class, 'product_id');
    }

    public function images(){
        return $this->hasMany(CompanyCatalogueImage::class, 'company_catalogue_id');
    }

    public function cycle(){
        return $this->hasOne(CompanyBillingCycle::class, 'id', 'billing_cycle');
    }

    public function tax(){
        return $this->hasOne(CompanyTax::class, 'id', 'vat');
    }




}
