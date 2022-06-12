<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash_type extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'type',
        'desc',
        'start_bal',
        'end_bal',
        'in',
        'out',
    ];
}
