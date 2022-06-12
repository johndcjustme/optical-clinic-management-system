<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'post_comment_id',
        'post_type',
        // 'reacted_by_patient_user_id',
        // 'reacted_by_role',
        // 'role',
        // 'like_dislike',
    ];

    public function post() 
    {
        return $this->belongsTo(Post::class, 'post_comment_id', 'id');
    }

    public function comment() 
    {
        return $this->belongsTo(Comment::class, 'post_comment_id', 'id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'patient_user_id', 'id');
    }

    public function patient() 
    {
        return $this->belongsTo(Patient::class, 'patient_user_id', 'id');
    }
}
