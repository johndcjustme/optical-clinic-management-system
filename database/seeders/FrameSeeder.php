<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Frame;
use Carbon;
use Faker;

class FrameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $frame = Frame::create([
            'supplier_id' => 1,
            'frame_photo_path' => Str::random(5),
            'frame_name' => Str::random(4) . " " . Str::random(7),
            'frame_size' => '24 x 28',
            'frame_qty' => 45,
            'frame_desc' => Str::random(8),
            'item_type' => Str::random(4),
            'frame_price' => 1500,
            'created_at' => now(),
            'updated_at' => now(),
        ]);    
    }
}
