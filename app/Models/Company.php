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

    public function getCompanyImageAttribute(){
        if (!empty($this->image)){
            return asset("uploads/img/$this->image");
        }else{
            return "https://ui-avatars.com/api/?name=$this->name&color=FFFFFF&background=563C5C";
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
