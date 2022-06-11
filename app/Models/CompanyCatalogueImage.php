<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyCatalogueImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getPictureAttribute(){
        return asset("uploads/img/catalogues/$this->image");
    }

    public function catalogue(){
        return $this->belongsTo(CompanyCatalogue::class, 'company_catalogue_id');
    }
}
