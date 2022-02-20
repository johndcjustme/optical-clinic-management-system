<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = User::create([
            'name' => $faker->name,
            'email' => Str::random(5) . '@test.com',
            'password' => Str::random(8),
            'user_role' => 'admin',
        ]);
    }
}
