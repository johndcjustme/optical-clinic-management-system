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


        Supplier::create([
            'supplier_name' => $faker->name,
            'supplier_contact_no' => '09384938921',
            'supplier_address' => $faker->address,
            'supplier_bank' => 'bank name',
            'supplier_acc_no' => $faker->bankAccountNumber,
            'supplier_branch' => 'Tandag branch',
            'supplier_email' => $faker->email,
        ]);
    
    }
}
