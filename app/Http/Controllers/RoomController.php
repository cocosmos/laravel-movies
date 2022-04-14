<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Cinema;
use App\Models\Room;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
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

        return view('rooms.index', ['rooms' => Room::orderBy('name', 'ASC')->get(), "cinemas" => Cinema::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Room $room
     * @return Application|Factory|View
     */
    public function create(Room $room): View|Factory|Application
    {

        return view("rooms.create", ["rooms" => $room, 'cinemas' => Cinema::orderBy('name', 'ASC')->get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoomRequest $request
     * @return RedirectResponse
     */
    public function store(RoomRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        Room::create($data);
        return redirect()->route("room.index")
            ->with("ok", __("Room has been saved"));
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @return void
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Room $room
     * @return Application|Factory|View
     */
    public function edit(Room $room): View|Factory|Application
    {
        return view("rooms.edit", ["room" => $room, 'cinemas' => Cinema::orderBy('name', 'ASC')->get()]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoomRequest $request
     * @param Room $room
     * @return RedirectResponse
     */
    public function update(RoomRequest $request, Room $room): RedirectResponse
    {
        if ($room->user_id == Auth::user()->id) {
            $data = $request->all();
            $room->update($data);
            return redirect()->route("room.index")
                ->with("ok", __("Movie has been updated"));
        }

        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @return RedirectResponse
     */
    public function destroy(Room $room): RedirectResponse
    {
        if ($room->user_id == Auth::user()->id) {

            $room->delete();
            return redirect()->back();
        }

        abort(403, 'Unauthorized action.');

    }
}
