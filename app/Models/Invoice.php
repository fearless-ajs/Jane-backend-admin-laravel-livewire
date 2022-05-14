<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function contactInfo(){
       return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function worker(){
        return $this->hasOne(Worker::class, 'id', 'worker_id');
    }

    public function services(){
        return $this->hasMany(InvoiceService::class, 'invoice_id');
    }

    public function products(){
        return $this->hasMany(InvoiceProduct::class, 'invoice_id');
    }
}
