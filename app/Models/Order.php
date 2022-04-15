<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'patient_id',
        'order_code',
        'order_status',
        'order_desc', 
        'total', 
        'discount', 
        'balance', 
        'deposit', 
        'duedate', 
        'order_due',
        'received_at',
        'claimed_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function ordered_item()
    {
        return $this->hasMany(Ordered_item::class);
    }
}
