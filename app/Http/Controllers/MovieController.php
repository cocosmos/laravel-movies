<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Artist;

use App\Http\Requests\MovieRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
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
        return view('movies.index', ['movies'=>Movie::orderBy('title', 'ASC')->get(), "countries"=> Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Movie $movie
     * @return Application|Factory|View
     */
    public function create(Movie $movie): View|Factory|Application
    {

        return view("movies.create", ["movie" => $movie,'artists'=>Artist::orderBy('name', 'ASC')->get(), "countries"=> Country::orderBy('name', 'ASC')->get()]);

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
       //$data["poster"]=$request->file("poster")->getClientOriginalName();
        $data["poster"] = $request->input('title')."_".bin2hex(random_bytes(5)). ".jpg";

        Movie::create($data);

        $poster = $request->file("poster");
        Image::make($poster)->fit(412,608)
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
        return view("movies.edit", ["movie" => $movie, 'artists'=>Artist::orderBy('name', 'ASC')->get(), "countries"=> Country::orderBy('name', 'ASC')->get()]);
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
        $data = $request->all();
        $data["poster"] = $request->input('title')."_".bin2hex(random_bytes(5)). ".jpg";

        $movie->update($data);
        $request->file("poster");

        $poster = $request->file("poster");

        Image::make($poster)->fit(412,608)
            ->save(storage_path("app/public/uploads/posters/" . $data["poster"]));

        return redirect()->route("movie.index")
                        ->with("ok", __("Movie has been updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return JsonResponse
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json();
    }


}
