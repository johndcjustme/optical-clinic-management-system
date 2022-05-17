<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker;
use Illuminate\Support\Str;



class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();


        for($i = 0; $i < 13; $i++) {
            Item::create([
                'item_name' => Str::random(10),
                'category_id' => 1,
                'item_desc' => 'Item description and description',
                'item_size' => '234x453',
                'item_type' => 'le',
                'item_price' => '1500',
                'supplier_id' => 1,
                'item_qty' => 0,
                'item_buffer' => 0,
            ]);
        }
    }
}
