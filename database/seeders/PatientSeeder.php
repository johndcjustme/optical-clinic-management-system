<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('patients')->insert([
            'patient_photo_path' => 'nopath',
            'patient_fname' => 'John',
            'patient_lname' => 'Dc',
            'patient_mname' => 'M',
            'patient_address' => 'tandag',
            'patient_age' => 40,
            'patient_occupation' => 'engineer',
            'patient_mobile' => '1234567890',
            'patient_email' => Str::random(4). '@test.com',
            'patient_gender' => 'male',
        ]);
        DB::table('patients')->insert([
            'patient_photo_path' => 'nopath',
            'patient_fname' => 'Nino',
            'patient_lname' => 'Telewik',
            'patient_mname' => 'a',
            'patient_address' => 'tandag',
            'patient_age' => 40,
            'patient_occupation' => 'engineer',
            'patient_mobile' => '1234567890',
            'patient_email' => Str::random(4). '@test.com',
            'patient_gender' => 'male',
        ]);
        DB::table('patients')->insert([
            'patient_photo_path' => 'nopath',
            'patient_fname' => 'Jevie',
            'patient_lname' => 'bajan',
            'patient_mname' => 'q',
            'patient_address' => 'tandag',
            'patient_age' => 40,
            'patient_occupation' => 'engineer',
            'patient_mobile' => '1234567890',
            'patient_email' => Str::random(4). '@test.com',
            'patient_gender' => 'male',
        ]);
    }
}
