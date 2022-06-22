<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function contactInfo(){
       return $this->hasOne(Contact::class, 'id', 'contact_id');
    }

    public function contactSignature(){
        return $this->hasOne(InvoiceContactSignature::class, 'invoice_id', 'id');
    }

    public function worker(){
        return $this->hasOne(Worker::class, 'id', 'worker_id');
    }

    public function services(){
        return $this->hasMany(InvoiceCatalogue::class, 'invoice_id')->where('type', 'service');
    }

    public function products(){
        return $this->hasMany(InvoiceCatalogue::class, 'invoice_id')->where('type', 'product');
    }

    public function catalogues(){
        return $this->hasMany(InvoiceCatalogue::class, 'invoice_id');
    }
}
