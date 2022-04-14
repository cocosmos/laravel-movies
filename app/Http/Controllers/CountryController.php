<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
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
        return view('countries.index', ['countries' => Country::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view("countries.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request
     * @return RedirectResponse
     */
    public function store(CountryRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        Country::create($data);

        return redirect()->route("country.index")
            ->with("ok", __("Country has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|View
     */
    public function edit(Country $country): View|Factory|Application
    {
        return view("countries.edit", ["country" => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param Country $country
     * @return RedirectResponse
     */
    public function update(CountryRequest $request, Country $country): RedirectResponse
    {
        if ($country->user_id == Auth::user()->id) {

            $country->update($request->all());
            return redirect()->route("country.index")
                ->with("ok", __("Country has been updated"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        if ($country->user_id == Auth::user()->id) {
            $country->delete();

            return response()->json();
        }

        abort(403, 'Unauthorized action.');
    }

}
