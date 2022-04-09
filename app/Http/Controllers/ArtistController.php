<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use App\Models\Country;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

//use App\Http\Controllers\Auth;


class ArtistController extends Controller

{
    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
        $this->middleware('auth')->only('create');
        $this->middleware('auth')->only('edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
//        $LINK = "https://api.themoviedb.org/3/person/popular?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US&page=5";
//
//
//        $artists = json_decode(Http::get($LINK), true);
//
//        foreach ($artists["results"] as $artist) {
//            $img = storage_path("app/public/uploads/profiles" . $artist["profile_path"]);
//            $url = 'https://image.tmdb.org/t/p/w500' . $artist["profile_path"];
//
//
//            Image::make(file_get_contents($url))->fit(300, 300)
//                ->save($img);
//
//
//        }

//        for ($i = 1; $i < 50; $i++) {
//            $personLink = 'https://api.themoviedb.org/3/person/' . $i . '?api_key=a6e2a2fbd348b2a79b669a1ac0f1c36e&language=en-US';
//
//            $artist = json_decode(Http::get($personLink), true);
//
//
//            preg_match('/(^[a-zA-Z]+)/', $artist["name"], $firstname);
//            preg_match('/([a-zA-Z]+$)/', $artist["name"], $name);
//            // preg_match('/([a-zA-Z]+$)/', $artist["place_of_birth"], $country);
//            dd($name[0]);
//        }

        return view('artists.index', ['artists' => Artist::orderBy('firstname', 'ASC')->get()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function create(Artist $artist): View|Factory|Application
    {
        return view("artists.create", ["artist" => $artist, "countries" => Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArtistRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ArtistRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        $data["image"] = $request->input('name') . "_" . bin2hex(random_bytes(5)) . ".jpg";

        Artist::create($data);

        $image = $request->file("image");
        Image::make($image)->fit(500, 500)
            ->save(storage_path("app/public/uploads/profiles/" . $data["image"]));

        return redirect()->route("artist.index")
            ->with("ok", __("Artist has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function edit(Artist $artist): View|Factory|Application
    {
        return view("artists.edit", ["artist" => $artist, "countries" => Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArtistRequest $request
     * @param Artist $artist
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(ArtistRequest $request, Artist $artist): RedirectResponse
    {
        $data = $request->all();
        $data["image"] = $request->input('name') . "_" . bin2hex(random_bytes(5)) . ".jpg";
        $artist->update($data);
        $image = $request->file("image");
        Image::make($image)->fit(500, 500)
            ->save(storage_path("app/public/uploads/profiles/" . $data["image"]));

        return redirect()->route("artist.index")
            ->with("ok", __("Artist has been updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Artist $artist
     * @return JsonResponse
     */
    public function destroy(Artist $artist): JsonResponse
    {
        $artist->delete();

        return response()->json();
    }


}
