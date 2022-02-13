<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Accessory;


class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessory = Accessory::create([
            'accessory_photo_path' => Str::random(7),
            'accessory_name' => Str::random(3) . ' ' . Str::random(5),
            'accessory_desc' => Str::random(7),
            'accessory_qty' => 53,
            'accessory_price' => 2000,
            'item_type' => 'acessory',
            'created_at' => now(),
            'updated_at' => now(), 
        ]);
    }
}
