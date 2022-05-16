<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'patient_user_id',
        'post_content',
        // 'created_at',
        // 'updated_at',
        // 'role',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_user_id', 'id');
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'patient_user_id', 'id');
    // }
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_photos()
    {
        return $this->hasMany(Post_photo::class);
    }
}
