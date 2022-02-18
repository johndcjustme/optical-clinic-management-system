<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedsetting extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'schedset_name',
        'schedset_am',
        'schedset_pm',
        'schedset_checked',
    ];
}
