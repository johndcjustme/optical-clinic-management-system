<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'role',
        'patient_user_id',
        'comment_content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_user_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
