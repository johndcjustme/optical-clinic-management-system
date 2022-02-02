<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_photo_path',
        'patient_fname',
        'patient_lname',
        'patient_mname',
        'patient_age',
        'patient_gender',
        'patient_occupation',
        'patient_address',
        'patient_email',
        'patient_mobile',
    ];

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
}
