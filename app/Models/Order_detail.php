<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'exam_id',
        'patient_id',
        'order_code',
        'order_status',
        'order_desc', 

        'frames',
        'lense',
        'tint',
        'others',

        'total', 
        'discount', 
        'balance', 
        'deposit', 
        'duedate', 
        'order_due',
        'received_at',
        'claimed_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ordered_items()
    {
        return $this->hasMany(Ordered_item::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
