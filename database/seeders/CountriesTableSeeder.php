<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;


class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory()
                ->count(100)
                ->create();
        /* DB::table("countries")->insert([[
            "name" => "Albanie",
        ],
        [
            "name" => "Algérie",
        ],
        [
            "name" => "Allemagne",
        ],
        [
            "name" => "Argentine",
        ],
        [
            "name" => "Autriche",
        ],
        [
            "name" => "Russie",
        ],
        [
            "name" => "Ukraine",
        ],
        [
            "name"=>"Bahamas",
        ]]); */
    }
}
