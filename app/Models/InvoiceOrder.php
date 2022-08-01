<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
