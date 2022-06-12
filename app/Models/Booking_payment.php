<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'amount',
        'photo',
        'appointment_id',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
