<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringCataloguePaymentHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = [
        'updated_at',
        'created_at',
        'last_payment_date',
        'next_due_date',
        'deleted_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function catalogue(){
        return $this->belongsTo(CompanyCatalogue::class, 'catalogue_id');
    }

    public function activeService(){
        return $this->hasOne(ActiveService::class, 'active_service_id');
    }

}
