<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions(){
        return $this->hasMany(Transaction::class, 'contact_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
