<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'appt_date',
        'appt_resched',
        'appt_status',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
