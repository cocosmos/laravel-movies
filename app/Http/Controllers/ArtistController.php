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
        if ($artist->user_id == Auth::user()->id) {
            $data = $request->all();
            if (!isset($data["image"])) {
                $data["image"] = $artist->image;
            } else {
                $data["image"] = $request->input('name') . "_" . bin2hex(random_bytes(5)) . ".jpg";
                $image = $request->file("image");
                Image::make($image)->fit(500, 500)
                    ->save(storage_path("app/public/uploads/profiles/" . $data["image"]));
            }
            $artist->update($data);

            return redirect()->route("artist.index")
                ->with("ok", __("Artist has been updated"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Artist $artist
     * @return JsonResponse
     */
    public function destroy(Artist $artist): JsonResponse
    {
        if ($artist->user_id == Auth::user()->id) {
            $artist->delete();
            return response()->json();
        }

        abort(403, 'Unauthorized action.');

    }

    public function hasPlayed($id): Factory|View|Application
    {
        return view('artists.filmography', ["artist" => Artist::findOrFail($id), "movies" => Artist::find($id)->hasPlayed()->get()]);
        //return view('movies.actors', ["actors" => Movie::where("id", $id)->first()->actors()->get(), 'movie' => Movie::findOrFail($id), 'artists' => Artist::orderBy('name', 'ASC')->get()
    }

//    public function hasDirected($id): Factory|View|Application
//    {
//        return view('artists.filmography', ["artist" => Artist::findOrFail($id), "movies" => Artist::find($id)->hasDirected()->get()]);
//        //return view('movies.actors', ["actors" => Movie::where("id", $id)->first()->actors()->get(), 'movie' => Movie::findOrFail($id), 'artists' => Artist::orderBy('name', 'ASC')->get()
//    }


}
