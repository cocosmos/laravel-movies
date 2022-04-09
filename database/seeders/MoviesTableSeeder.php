<?php

namespace Database\Seeders;

use App\Models\Movie;
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
        $LINK = "https://api.themoviedb.org/3/discover/movie?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&with_original_language=en&sort_by=vote_count.desc&page=2";


        $movies = json_decode(Http::get($LINK), true);
        //var_dump($movies["results"][0]["original_title"]);
        foreach ($movies["results"] as $movie) {

            //for ($i = 0; $i < 50; $i++) {
            $apiLink = "https://api.themoviedb.org/3/movie/" . $movie["id"] . "?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US";
            $movie = json_decode(Http::get($apiLink), true);
            // $country = DB::table('countries')->where('name', $movie["production_countries"]["name"])->value('id');

            Movie::factory()
                ->create(
                    [
                        'title' => $movie["original_title"],
                        'year' => Carbon::parse($movie["release_date"])->format('Y'),
                        "director_id" => random_int(160, 180),
                        "country_id" => random_int(70, 100),
                        "length" => $movie["runtime"],
                        "poster" => $movie["poster_path"]

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
