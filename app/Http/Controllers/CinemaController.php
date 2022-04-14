<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaRequest;
use App\Models\Cinema;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CinemaController extends Controller
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
        return view('cinemas.index', ['cinemas' => Cinema::all(), "countries" => Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Cinema $cinema
     * @return Application|Factory|View
     */
    public function create(Cinema $cinema): View|Factory|Application
    {
        return view("cinemas.create", ["cinema" => $cinema, "countries" => Country::orderBy('name', 'ASC')->get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CinemaRequest $request
     * @return RedirectResponse
     */
    public function store(CinemaRequest $request): RedirectResponse
    {
        $data = $request->all();

        Cinema::create($data);
        return redirect()->route("cinema.index")
            ->with("ok", __("Cinema has been saved"));
    }

    /**
     * Display the specified resource.
     *
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cinema $cinema
     * @return Application|Factory|View
     */
    public function edit(Cinema $cinema): View|Factory|Application
    {
        return view("cinemas.edit", ["cinema" => $cinema, "countries" => Country::orderBy('name', 'ASC')->get()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param CinemaRequest $request
     * @param Cinema $cinema
     * @return RedirectResponse
     */
    public function update(CinemaRequest $request, Cinema $cinema): RedirectResponse
    {
        $data = $request->all();
        $cinema->update($data);

        return redirect()->route("cinema.index")
            ->with("ok", __("Cinema has been updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cinema $cinema
     * @return RedirectResponse
     */
    public function destroy(Cinema $cinema): RedirectResponse
    {
        $cinema->delete();
        return redirect()->back();
    }
}
