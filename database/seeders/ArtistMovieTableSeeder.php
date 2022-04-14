<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ArtistMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $LINK = "https://api.themoviedb.org/3/discover/movie?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&with_original_language=en&sort_by=vote_count.desc&page=1";
        $movies = json_decode(Http::get($LINK), true);


        foreach ($movies["results"] as $movie) {
            $cast = "https://api.themoviedb.org/3/movie/" . $movie["id"] . "/credits?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US";

            $artists = json_decode(Http::get($cast), true);
            foreach ($artists["cast"] as $artist) {
                preg_match('/(^[a-zA-Z]+)/', $artist["name"], $firstname);
                preg_match('/([a-zA-Z]+$)/', $artist["name"], $name);

                if ($artist["known_for_department"] == "Acting" | isset($artist["job"]) == "Director" && isset($artist["profile_path"]) && isset($name[0])) {

                    DB::table("artist_movie")->insert(['role' => $artist["character"], "movie_id" => Movie::where("title", $movie["original_title"])->first()->id, "artist_id" => Artist::where("firstname", $firstname[0])->where("name", $name[0])->first()->id]);

                    // Movie::where("title", $movie["original_title"])->actors()->attach(Artist::where("firstname", $firstname[0])->where("name", $name[0]), ['role' => $artist["character"]]);
                }
            }
        }
    }
}
