<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit_content extends Model
{
    use HasFactory;

    public $fillable = [
        'credit_id',
        'payment_type',
        'payment',
    ];

    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
