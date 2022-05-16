<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
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

    public function products(){
        return $this->hasMany(Product::class,'company_id');
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

    public function users(){
        return $this->hasMany(Worker::class,'company_id');
    }
}
