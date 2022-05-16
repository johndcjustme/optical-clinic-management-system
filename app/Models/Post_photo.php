<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_photo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'post_id',
        'name',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
