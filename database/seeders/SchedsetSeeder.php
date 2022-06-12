<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Schedsetting;
use Faker;


class SchedsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sunday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'sunday', 
        ]);
        $monday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'monday', 
        ]);
        $tuesday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'tuesday', 
        ]);
        $wednesday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'wednesday', 
        ]);
        $thursday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'thursday', 
        ]);
        $friday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'friday', 
        ]);
        $saturday = Schedsetting::create([
            'schedset_type' => 'schedsetting',
            'schedset_name' => 'saturday', 
        ]);
        
    }
}
