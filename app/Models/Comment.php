<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'comment_content',
        // 'patient_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
