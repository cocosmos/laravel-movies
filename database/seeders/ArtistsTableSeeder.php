<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Country;
use Carbon\Carbon;
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
        //   $LINK = "https://api.themoviedb.org/3/person/popular?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US&page=5";


        // $artists = json_decode(Http::get($LINK), true);

        //  foreach ($artists["results"] as $artist) {
        for ($i = 16; $i < 17; $i++) {
            // $apiLink = "https://api.themoviedb.org/3/movie/" . $i . "?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US";
            $personLink = 'https://api.themoviedb.org/3/person/' . $i . '?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US';

            $artist = json_decode(Http::get($personLink), true);

            if ($artist["success"] === "false") {
                Artist::factory()
                    ->create(
                        [
                            "name" => $this->faker->lastName(),
                            "firstname" => $this->faker->firstName(),
                            "birthdate" => $this->faker->numberBetween(1902, 2010),
                            "country_id" => Country::all()->random()->id,
                            "image" => "placeholder.jpg"
                        ]
                    );

            } else {
                preg_match('/(^[a-zA-Z]+)/', $artist["name"], $firstname);
                preg_match('/([a-zA-Z]+$)/', $artist["name"], $name);
                preg_match('/([a-zA-Z]+$)/', $artist["place_of_birth"], $country);
                Artist::factory()
                    ->create(
                        [
                            'firstname' => $firstname[0],
                            'name' => $name[0],
                            'birthdate' => Carbon::parse($artist["birthday"])->format('Y'),
                            "country_id" => random_int(70, 100),
                            "image" => $artist["profile_path"]
                        ]
                    );

                $img = storage_path("app/public/uploads/profiles" . $artist["profile_path"]);
                $url = 'https://image.tmdb.org/t/p/w500' . $artist["profile_path"];
                Image::make(file_get_contents($url))->fit(500, 500)
                    ->save($img);

            }


        }
//
//
//        Artist::factory()
//                ->count(50)
//                ->create();
    }
}
