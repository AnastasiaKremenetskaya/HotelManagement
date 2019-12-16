<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsController extends AdminPagesController
{
    private $roomInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $rooms = Room::paginate($this->roomInPage);
        return $this->renderOutputAdmin("rooms.list", [
            "rooms" => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $room_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return $this->renderOutputAdmin('rooms.form', [
            'route' => route('admin.rooms.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create the request
        Room::create($request->all());

        return redirect()->route("admin.rooms.index")->withSuccess("Комната успешно добавлена");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $room = Room::whereId($id)->first();
        return $this->renderOutputAdmin("rooms.form", [
            "room" => $room,
            "route" => route("admin.rooms.update", ["id_room" => $id]),
            "update" => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {

        Room::whereId($room->id)->update($request->all());

        return redirect()->route("admin.rooms.index")->withSuccess("Комната изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $extraService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::whereId($id)->delete();

        return redirect()->route("admin.rooms.index")->withSuccess("Комната успешно удалена");
    }
}
