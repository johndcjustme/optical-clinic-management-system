<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Patient;
use Faker;

// use ArielMejiaDev\LarapexCharts\LarapexChart;



class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Patient::create([
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

        Patient::create([
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


        Patient::create([
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


        Patient::create([
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


        Patient::create([
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


        Patient::create([
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


        Patient::create([
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


        Patient::create([
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


        //
        // DB::table('patients')->insert([
        //     'patient_photo_path' => 'nopath',
        //     'patient_fname' => 'John',
        //     'patient_lname' => 'Dc',
        //     'patient_mname' => 'M',
        //     'patient_address' => 'tandag',
        //     'patient_age' => 40,
        //     'patient_occupation' => 'engineer',
        //     'patient_mobile' => '1234567890',
        //     'patient_email' => Str::random(4). '@test.com',
        //     'patient_gender' => 'male',
        // ]);


    }
}
