<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $LINK = "https://restcountries.com/v3.1/all";
        $countries = json_decode(Http::get($LINK), true);

        foreach ($countries as $country) {

            Country::factory()
                ->create(
                    [
                        "name" => $country["name"]["common"],
                        "user_id" => User::all()->random()->id,

                    ]);
        }


//        Country::factory()
//            ->count(150)
//            ->create();
    }


}
