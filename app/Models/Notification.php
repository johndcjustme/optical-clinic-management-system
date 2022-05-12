<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'desc',
        'title',
        'link',
        'is_read',
        'read_at',
    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }
}
