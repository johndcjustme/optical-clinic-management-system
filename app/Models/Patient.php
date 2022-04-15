<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'patient_avatar',
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
        'patient_queue',
        'patient_exam_status',
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

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
