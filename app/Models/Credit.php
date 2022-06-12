<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'patient_id',
        'total',
        'due',
    ];  

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function credit_content()
    {
        return $this->hasMany(Credit_content::class);
    }
}
