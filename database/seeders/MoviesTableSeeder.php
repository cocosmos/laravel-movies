<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Country;
use App\Models\Movie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;


class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()

    {
        $LINK = "https://api.themoviedb.org/3/discover/movie?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&with_original_language=en&sort_by=vote_count.desc&page=1";


        $movies = json_decode(Http::get($LINK), true);
        foreach ($movies["results"] as $movie) {

            $apiLink = "https://api.themoviedb.org/3/movie/" . $movie["id"] . "?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US";
            $movie = json_decode(Http::get($apiLink), true);

            Movie::factory()
                ->create(
                    [
                        'title' => $movie["original_title"],
                        'year' => Carbon::parse($movie["release_date"])->format('Y'),
                        "director_id" => Artist::all()->random()->id,
                        "country_id" => Country::all()->random()->id,
                        "length" => $movie["runtime"],
                        "poster" => $movie["poster_path"],
                        "user_id" => User::all()->random()->id,

                    ]
                );

            $img = storage_path("app/public/uploads/posters" . $movie["poster_path"]);
            $url = 'https://image.tmdb.org/t/p/w500' . $movie["poster_path"];
            Image::make(file_get_contents($url))
                ->save($img);
        }


        // }
//        Movie::factory()
//                ->count(100)
//                ->create();
    }
}
