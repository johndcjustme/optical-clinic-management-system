<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Lense;
use Carbon;
use Faker;

class LenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $lense = Lense::create([
            'supplier_id' => 1,
            'lense_photo_path' => 'photo_path',
            'lense_name' => Str::random(10),
            'lense_desc' => Str::random(8),
            'lense_qty' => 15,
            'lense_tint' => Str::random(7),
            'item_type' => 'lense',
            'lense_price' => 3000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
