<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function bankingInfo(){
        return $this->hasOne(CompanyTransactionInfo::class,  'company_id');
    }

    public function getCompanyBannerAttribute(){
        if (!empty($this->banner)){
            return asset("uploads/img/$this->banner");
        }else{
             return asset("uploads/img/company-banner.jpg");
        }
    }

    public function permissions(){
        return $this->hasMany(CompanyPermission::class,'company_id');
    }

    public function roles(){
        return $this->hasMany(CompanyRole::class,'company_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'company_id');
    }

    public function catalogues(){
        return $this->hasMany(CompanyCatalogue::class,'company_id');
    }


    public function services(){
        return $this->hasMany(Service::class,'company_id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class,'company_id');
    }

    public function contacts(){
        return $this->hasMany(Contact::class,'company_id');
    }

    public function categories(){
        return $this->hasMany(Category::class,'company_id');
    }

    public function users(){
        return $this->hasMany(Worker::class,'company_id');
    }

    public function billingCycles(){
        return $this->hasMany(CompanyBillingCycle::class,'company_id');
    }
}
