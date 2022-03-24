<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;


class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()
                ->count(100)
                ->create();
        /*
        DB::table("movies")->insert([[
            "title" => "Les affranchis",
            "year" => "1990",
        ],
        [
            "title" => "Le loup de Wall Street",
            "year" => "2013",
        ],
        [
            "title" => "Silence",
            "year" => "2016",
        ],
        [
            "title" => "le seigneur des anneaux",
            "year" => "2001",
        ],
        [
            "title" => "Aviator",
            "year" => "2004",
        ],
        [
            "title" => "Interstellar",
            "year" => "2014",
        ],
        [
            "title"=>"Inception",
            "year"=>"2010",
        ]]);*/
    }
}
