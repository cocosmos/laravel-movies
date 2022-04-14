<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;

class ArtistsTableSeeder extends Seeder
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
                //Check all requirements
                if ($artist["known_for_department"] == "Acting" | isset($artist["job"]) == "Director" && isset($artist["profile_path"]) && isset($name[0])) {
                    //Check if already exist

                    if (Artist::where("firstname", $firstname[0])->where("name", $name[0])->doesntExist()) {
                        Artist::factory()
                            ->create(
                                [
                                    'firstname' => ($firstname[0] ?? ""),
                                    'name' => ($name[0] ?? ""),
                                    'birthdate' => random_int(1950, 2000),
                                    "country_id" => Country::all()->random()->id,
                                    "image" => $artist["profile_path"],
                                    "user_id" => User::all()->random()->id,
                                ]
                            );
                        $img = storage_path("app/public/uploads/profiles" . $artist["profile_path"]);
                        $url = 'https://image.tmdb.org/t/p/w500' . $artist["profile_path"];
                        Image::make(file_get_contents($url))->fit(500, 500)
                            ->save($img);
                    }

                }


            }


        }

//        Artist::factory()
//                ->count(50)
//                ->create();
    }
}
