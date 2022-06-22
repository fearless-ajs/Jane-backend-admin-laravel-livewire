<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceCatalogue extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function catalogue(){
        return $this->belongsTo(CompanyCatalogue::class, 'catalogue_id');
    }


//    public function getSignatureImageAttribute(){
//        return asset("uploads/img/signatures/$this->filename");
//    }

}
