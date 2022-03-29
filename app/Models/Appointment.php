<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'appt_date',
        'appt_time',
        'appt_resched',
        'appt_status',
        'appt_confirmed',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
