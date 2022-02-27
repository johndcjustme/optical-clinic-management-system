<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = Post::create([
            'patient_user_id' => 4,
            'role' => 'admin',
            'post_content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe deserunt perspiciatis quam repudiandae molestias! Reiciendis labore adipisci quos ipsa in!',
        ]);
    }
}
