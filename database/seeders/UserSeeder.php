<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = User::create([
            'name' => 'john',
            'email' => 'john@test.com',
            'password' => Hash::make('password'),
            'user_role' => '0',
        ]);
    }
}
