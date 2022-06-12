<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Exam;
use App\Models\Tab;
use App\Models\Day;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Appointment_category;
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


        Category::create([
            'name' => 'Lense',
        ]);

        Category::create([
            'name' => 'Frame',
        ]);

        Category::create([
            'name' => 'Accessory',
        ]);



        Supplier::create([
            'supplier_name' => $faker->name,
            'supplier_contact_no' => '09484710735',
            'supplier_address' => 'manila',
            'supplier_bank' => Str::random(7),
            'supplier_acc_no' => '12345677account',
            'supplier_branch' => Str::random(10) . 'branch',
            'supplier_email' => Str::random(7) . '@email.com',
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





        Appointment_category::create([
            'id' => 22,
            'title' => 'For Approval', 
        ]);

        Appointment_category::create([
            'id' => 33,
            'title' => 'Approved', 
        ]);

        Appointment_category::create([
            'id' => 44,
            'title' => 'Fullfilled', 
        ]);

        Appointment_category::create([
            'id' => 55,
            'title' => 'Canceled', 
        ]);

        Appointment_category::create([
            'id' => 66,
            'title' => 'Rescheduled', 
        ]);

        Appointment_category::create([
            'id' => 77,
            'title' => 'Missed', 
        ]);







        Setting::create([
            'code' => 11,
            'title' => 'Scheduling',
            'status' => false,
        ]);
    }
}
