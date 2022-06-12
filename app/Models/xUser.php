<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'user_role',
        'passcode',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'patient_admin_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function like()
    {
        return $this->hasMany(Like::class);
    }

    // public function curr_user() 
    // {
    //     if(session()->has('curr_user_id')) {
            
    //         return $this->mysession_name = session()->get('curr_user_name');
    //         // $this->mysession_id = session()->get('curr_user_id');
    //         // $this->mysession_avatar = session()->get('curr_user_avatar');
    //         // $this->mysession_role = session()->get('curr_user_role');
    //         // $this->mysession_email = session()->get('curr_user_email');
    //         // $this->mysession_passcode = session()->get('curr_user_passcode');

    //     } else {
    //         $this->mysession = 'nothig';
    //     }
    // }
}
