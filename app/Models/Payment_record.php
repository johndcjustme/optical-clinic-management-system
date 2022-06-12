<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_record extends Model
{
    use HasFactory;


    public $fillable = [
        'payment_id',
        'pay_amount',
        'payment_type',
        'description',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
