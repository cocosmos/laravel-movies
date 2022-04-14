<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = ["test@example.com", "test2@xample.com"];
        foreach ($emails as $email) {
            User::factory()
                ->create([
                    "id" => random_int(3, 4),
                    'name' => $this->faker->name(),
                    'email' => $email,
                    'email_verified_at' => now(),
                    'password' => '$2y$10$2CesC9WMbHJVXnImu5HDsOyOXCLTDk9INR1CfJqTQRa7cVZuHcWue', // test12345
                    'remember_token' => Str::random(10),
                ]);
        }
//        User::factory()
//            ->count(2)
//            ->create();


    }
}
