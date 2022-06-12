<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_in_comment extends Model
{
    use HasFactory;

    public $fillable = [
        'comment_id',
        'user_id',
        'comment',
    ];

    public function comment()
    {
        $this->belongsTo(Comment::class);
    }

    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}
