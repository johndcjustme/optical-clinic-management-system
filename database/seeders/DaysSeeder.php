<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Day;


class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create([
           'day' => 'Monday', 
           'status' => false, 
        ]);

        Day::create([
            'day' => 'Tuesday', 
            'status' => false, 
         ]);

         Day::create([
            'day' => 'Wednesday', 
            'status' => false, 
         ]);

         Day::create([
            'day' => 'Thursday', 
            'status' => false, 
         ]);

         Day::create([
            'day' => 'Friday', 
            'status' => false, 
         ]);

         Day::create([
            'day' => 'Saturday', 
            'status' => false, 
         ]);

         Day::create([
            'day' => 'Sunday', 
            'status' => false, 
         ]);



    }
}
