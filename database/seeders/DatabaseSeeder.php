<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Exam;
use App\Models\Tab;
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

        $patient = Patient::create([
            'patient_photo_path' => 'path/photo',
            'patient_fname' => Str::random(4),
            'patient_lname' => Str::random(5),
            'patient_mname' => Str::random(4), 
            'patient_address' => Str::random(5) . 'address',
            'patient_age' => 23,
            'patient_occupation' => Str::random(7),
            'patient_mobile' => 12344567678,
            'patient_email' => Str::random(4) . '@test.com',
            'patient_gender' => 'male',
        ]);

        $exam = Exam::create([
            'patient_id' => $patient->id,
        ]);

        $tab = Tab::create([
            'user_id' => 1,
            'inventory_active_tab' => 1,
        ]);
    }
}
