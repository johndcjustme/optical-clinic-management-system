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

        $le = collect([
            'Single vision', 
            'Bifocal',
            'Trifocal',
            'Progressive',
            'Toric',
            'Prism'
        ]);

        $fr = collect([
            'Full-Rimmed',
            'Rimless',
            'Semi-Rimless',
            'Wire Frames',
            'Plastic Eyeglasses Frames',
            'Acetate Eyeglasses Frames',
            'Wood Texture Eyeglasses Frames'
        ]);

        $ac = collect([
            'Lens Cleaners',
            'Eyewear Retainers',
            'Eyeglass Cases',
            'Eyeglass Nose Pads',
            'Eyeglass Repair Kits',
            'Chums Croakies'
        ]);


        for($i = 0; $i < 5; $i++) {
            Item::create([
                'item_name' => $le->random(),
                'category_id' => 1,
                'item_desc' => 'Lorem ipsum dolor sit amet.',
                // 'item_size' => '234x453',
                // 'item_type' => 'le',
                'item_price' => '1500',
                'supplier_id' => 1,
                'item_qty' => 0,
                'item_buffer' => 0,
            ]);
        }

        for($i = 0; $i < 5; $i++) {
            Item::create([
                'item_name' => $fr->random(),
                'category_id' => 2,
                'item_desc' => 'Lorem ipsum dolor sit amet.',
                'item_size' => '54-20-40',
                // 'item_type' => 'le',
                'item_price' => '1500',
                'supplier_id' => 1,
                'item_qty' => 0,
                'item_buffer' => 0,
            ]);
        }


        for($i = 0; $i < 5; $i++) {
            Item::create([
                'item_name' => $ac->random(),
                'category_id' => 3,
                'item_desc' => 'Lorem ipsum dolor sit amet.',
                // 'item_size' => '54-20-40',
                // 'item_type' => 'le',
                'item_price' => '1500',
                'supplier_id' => 1,
                'item_qty' => 0,
                'item_buffer' => 0,
            ]);
        }
    }
}
