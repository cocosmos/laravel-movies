<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Artist;

use App\Http\Requests\MovieRequest;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index', ['movies'=>Movie::all(), "countries"=> Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Movie $movie)
    {
       
        return view("movies.create", ["movie" => $movie,'artists'=>Artist::all(), "countries"=> Country::all()]);

    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request, Movie $movie)
    {
        
        
        $data = $request->all();
        $data["poster"]=$request->file("poster")->getClientOriginalName();
        Movie::create($data);
        
        $poster = $request->file("poster");
        Image::make($poster)->fit(180,240)
                        ->save(storage_path("app/public/uploads/posters/" . $data["poster"]));

        
        return redirect()->route("movie.index")
                        ->with("ok", __("Movie has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view("movies.edit", ["movie" => $movie, 'artists'=>Artist::all(), "countries"=> Country::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());
        $poster = $request->file("poster");
        $filename ="poster_" . $movie->id . '.' . $poster->guessClientExtension();
        Image::make($poster)->fit(180,240)
                        ->save(storage_path("app/public/uploads/posters/" . $filename));


        return redirect()->route("movie.index")
                        ->with("ok", __("Movie has been updated"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json();
    }

    
}
