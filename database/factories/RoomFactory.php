<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->numerify('Room-####'),
            "size" => random_int(50, 300),
            "cinema_id" => Cinema::all()->random()->id,
            "user_id" => User::all()->random()->id,
        ];
    }
}
