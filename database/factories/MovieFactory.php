<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use App\Models\Artist;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word(),
            "year" => $this->faker->numberBetween(1902, 2010),
            "director_id" => Artist::all()->random()->id,
            "country_id" => Country::all()->random()->id
        ];
    }
}
