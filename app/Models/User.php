<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'avatar',
        'email',
        'password',
        'user_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function post()
    {
        return $this->hasMany(Post::class);
    }


    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function commentcomment()
    {
        return $this->hasMany(Commentcomment::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    } 

    public function hasmessage()
    {
        return $this->hasOne(Message::class, 'sender_id', 'id')->latestOfMany();
    }

    public function chatroom()
    {
        return $this->hasOne(Chatroom::class, 'user_id', 'id');
    }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
