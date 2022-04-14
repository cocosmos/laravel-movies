<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->lastName(),
            "firstname" => $this->faker->firstName(),
            "birthdate" => $this->faker->numberBetween(1902, 2010),
            "country_id" => Country::all()->random()->id,
            "image" => "placeholder.jpg",
            "user_id" => User::all()->random()->id,
        ];
    }
}
