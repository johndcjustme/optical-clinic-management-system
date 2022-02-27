<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_user_id',
        'role',
        'post_content',
        'created_at',
        'updated_at',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_user_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_user_id', 'id');
    }
    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
