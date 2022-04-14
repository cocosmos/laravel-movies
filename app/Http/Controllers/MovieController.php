<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Movie;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
        $this->middleware('auth')->only('create');
        $this->middleware('auth')->only('edit');
        $this->middleware('auth')->only('attach');
        $this->middleware('auth')->only('detach');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {

        return view('movies.index', ['movies' => Movie::orderBy('title', 'ASC')->get(), "countries" => Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Movie $movie
     * @return Application|Factory|View
     */
    public function create(Movie $movie): View|Factory|Application
    {

        return view("movies.create", ["movie" => $movie, 'artists' => Artist::orderBy('name', 'ASC')->get(), "countries" => Country::orderBy('name', 'ASC')->get()]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param MovieRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(MovieRequest $request): RedirectResponse
    {

        $data = $request->all();
        $data["user_id"] = Auth::user()->id;

        $badChar = array(" ", ":", '"', "'", ";", "!", "$");
        $cleanTitle = str_replace($badChar, "_", $request->input('title'));
        $data["poster"] = $cleanTitle . "_" . bin2hex(random_bytes(5)) . ".jpg";

        Movie::create($data);

        $poster = $request->file("poster");
        Image::make($poster)->fit(412, 608)
            ->save(storage_path("app/public/uploads/posters/" . $data["poster"]));

        return redirect()->route("movie.index")
            ->with("ok", __("Movie has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return Application|Factory|View
     */
    public function edit(Movie $movie): View|Factory|Application
    {
        return view("movies.edit", ["movie" => $movie, 'artists' => Artist::orderBy('name', 'ASC')->get(), "countries" => Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovieRequest $request
     * @param Movie $movie
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(MovieRequest $request, Movie $movie): RedirectResponse
    {
        if ($movie->user_id == Auth::user()->id) {
            $data = $request->all();

            if (!isset($data["poster"])) {
                $data["poster"] = $movie->poster;
            } else {
                $badChar = array(" ", ":", '"', "'", ";", "!", "$");
                $cleanTitle = str_replace($badChar, "_", $request->input('title'));

                $data["poster"] = $cleanTitle . "_" . bin2hex(random_bytes(5)) . ".jpg";
                $request->file("poster");

                $poster = $request->file("poster");
                Image::make($poster)->fit(412, 608)
                    ->save(storage_path("app/public/uploads/posters/" . $data["poster"]));
            }

            $movie->update($data);


            return redirect()->route("movie.index")
                ->with("ok", __("Movie has been updated"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function destroy(Movie $movie): JsonResponse
    {
        if ($movie->user_id == Auth::user()->id) {

            $movie->delete();

            return response()->json();
        }

        abort(403, 'Unauthorized action.');
    }

    public function actors($id): Factory|View|Application
    {

        return view('movies.actors', ["actors" => Movie::where("id", $id)->first()->actors()->get(), 'movie' => Movie::findOrFail($id), 'artists' => Artist::orderBy('name', 'ASC')->get()]);
    }


    public function attach(Request $request, Movie $movie): RedirectResponse
    {

        if ($movie->user_id == Auth::user()->id) {
            $data = $request->all();
            $movie->actors()->attach($data["artist_id"], ['role' => $data["role"]]);

            return redirect()->route("movie.actors", $movie)
                ->with("ok", __("Actor has been added"));
        }

        abort(403, 'Unauthorized action.');
    }

    public function detach(Movie $movie, $actorid): RedirectResponse
    {
        if ($movie->user_id == Auth::user()->id) {
            $movie->actors()->detach(Artist::find($actorid));
            return redirect()->route("movie.actors", $movie)
                ->with("ok", __("Actor has been removed"));
        }

        abort(403, 'Unauthorized action.');


    }

}
