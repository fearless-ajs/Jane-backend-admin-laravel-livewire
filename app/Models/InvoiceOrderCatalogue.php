<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceOrderCatalogue extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function catalogue(){
        return $this->belongsTo(CompanyCatalogue::class, 'catalogue_id');
    }

    public function invoiceOrder(){
        return $this->belongsTo(InvoiceOrder::class, 'invoice_order_id');
    }

}
