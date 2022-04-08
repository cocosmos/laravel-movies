<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ArtistRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

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

        return view('artists.index', ['artists'=>Artist::orderBy('firstname', 'ASC')->get()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function create(Artist $artist): View|Factory|Application
    {
        return view("artists.create", ["artist" => $artist, "countries"=> Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArtistRequest $request
     * @return RedirectResponse
     */
    public function store(ArtistRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data["user_id"]=Auth::user()->id;
        Artist::create($data);

        return redirect()->route("artist.index")
                        ->with("ok", __("Artist has been saved"));
    }

//    /**
//     * Display the specified resource.
//     *
//     * @return Response
//     */
//    public function show(): Response
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Artist $artist
     * @return Application|Factory|View
     */
    public function edit(Artist $artist): View|Factory|Application
    {
        return view("artists.edit", ["artist" => $artist, "countries"=> Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArtistRequest $request
     * @param Artist $artist
     * @return RedirectResponse
     */
    public function update(ArtistRequest $request, Artist $artist): RedirectResponse
    {
        $artist->update($request->all());

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
