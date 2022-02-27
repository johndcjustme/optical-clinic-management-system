<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient1 = Like::create([
            'post_comment_id' => 2,
            'patient_user_id' => 1,
            'role' => 'patient',
            'like_dislike' => 1,
        ]);
    }
}
