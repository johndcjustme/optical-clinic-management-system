<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment1 = Comment::create([
            'post_id' => 1,
            'patient_user_id' => 1,
            'role' => 'patient',
            'comment_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum!',
        ]);
        $comment2 = Comment::create([
            'post_id' => 1,
            'patient_user_id' => 2,
            'role' => 'patient',
            'comment_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum!',
        ]);
        $comment1 = Comment::create([
            'post_id' => 1,
            'patient_user_id' => 1,
            'role' => 'admin',
            'comment_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum!',
        ]);
    }
}
