<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Patient;
use Faker;

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

        $patient1 = Patient::create([
            'patient_avatar' => 'default-avatar-pt.png',
            'patient_fname' => $faker->name, 
            'patient_lname' => $faker->name,
            'patient_mname' => 'S',
            'patient_mobile' => '094848484848',
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
