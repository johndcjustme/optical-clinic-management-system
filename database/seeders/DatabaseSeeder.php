<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Exam;
use App\Models\Tab;
use App\Models\Day;
use App\Models\Setting;
use Illuminate\Support\Str;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $this->call(LaratrustSeeder::class);

        Day::create([
            'day' => 'Monday',
            'status' => false,
        ]);

        Day::create([
            'day' => 'Monday',
            'status' => false,
        ]);
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


        Setting::create([
            'code' => 11,
            'title' => 'Scheduling',
            'status' => false,
        ]);
    }
}
