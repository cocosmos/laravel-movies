<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory
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
