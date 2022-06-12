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
        'schedset_am_from',
        'schedset_am_to',
        'schedset_pm_from',
        'schedset_pm_to',
        'schedset_checked',
    ];
}
