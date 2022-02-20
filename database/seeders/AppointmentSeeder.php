<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;


class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appt1 = Appointment::create([
            'patient_id' => 1,                    
            'appt_date' => date('m-d-Y'),
            'appt_status' => 'ongoing',
        ]);
        $appt2 = Appointment::create([
            'patient_id' => 2,                    
            'appt_date' => date('m-d-Y'),
            'appt_status' => 'ongoing',
        ]);
    }
}
