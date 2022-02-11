<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Supplier;
use Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $patient1 = Supplier::create([
            'supplier_name' => $faker->name,
            'supplier_contact_no' => '09484710735',
            'supplier_address' => 'manila',
            'supplier_bank' => Str::random(7),
            'supplier_acc_no' => '12345677account',
            'supplier_branch' => Str::random(10) . 'branch',
            'supplier_email' => Str::random(7) . '@email.com',
        ]);
    }
}
