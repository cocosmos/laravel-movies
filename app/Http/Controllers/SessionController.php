<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
        $this->middleware('auth')->only('create');
        $this->middleware('auth')->only('edit');

    }

    public function index(): Factory|View|Application
    {

        return view('sessions.index', ['sessions' => Session::orderBy('start_time', 'ASC')->get(), "rooms" => Room::all(), "movies" => Movie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Session $session
     * @return Application|Factory|View
     */
    public function create(Session $session): View|Factory|Application
    {
        return view('sessions.create', ['session' => $session, "rooms" => Room::orderBy('name', 'ASC')->get(), "movies" => Movie::orderBy('title', 'ASC')->get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SessionRequest $request
     * @return RedirectResponse
     */
    public function store(SessionRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        Session::create($data);
        return redirect()->route("session.index")
            ->with("ok", __("Session has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @param Session $session
     * @return void
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Session $session
     * @return Application|Factory|View
     */
    public function edit(Session $session): View|Factory|Application
    {
        return view('sessions.edit', ['session' => $session, "rooms" => Room::orderBy('name', 'ASC')->get(), "movies" => Movie::orderBy('title', 'ASC')->get()]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param SessionRequest $request
     * @param Session $session
     * @return RedirectResponse
     */
    public function update(SessionRequest $request, Session $session): RedirectResponse
    {
        if ($session->user_id == Auth::user()->id) {

            $data = $request->all();
            $session->update($data);
            return redirect()->route("session.index")
                ->with("ok", __("Session has been updated"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return mixed
     */
    public function destroy(Session $session): mixed
    {
        if ($session->user_id == Auth::user()->id) {


            $session->delete();
            return redirect()->json();
        }

        abort(403, 'Unauthorized action.');
    }
}
