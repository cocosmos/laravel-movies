<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "start_time" => $this->faker->dateTimeBetween('+1 week', '+4 week'),
            "room_id" => Room::all()->random()->id,
            "movie_id" => Movie::all()->random()->id,
            "user_id" => User::all()->random()->id,
        ];
    }
}
