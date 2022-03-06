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
        'patient_password',
    ];

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
