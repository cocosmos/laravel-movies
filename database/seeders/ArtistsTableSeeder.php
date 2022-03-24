<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::factory()
                ->count(50)
                ->create();
/*
        DB::table("artists")->insert([[
            "name" => "Coppola",
            "firstname" => "Francis Ford",
            "birthdate" => "1939",
        ],
        [
            "name" => "Jackson",
            "firstname" => "Peter",
            "birthdate" => "1961",
        ],
        [
            "name" => "Burton",
            "firstname" => "Tim",
            "birthdate" => "1958",
        ],
        [
            "name" => "Scorsese",
            "firstname" => "Martin",
            "birthdate" => "1942",
        ],
        [
            "name"=>"Lynch",
            "firstname"=>"David",
            "birthdate"=> "1946",
        ]]);*/
    }
}
