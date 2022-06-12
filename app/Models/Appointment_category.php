<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'status', 'title', 'desc', 'color', 'cname', 'notify',
    ];

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}