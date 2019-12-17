<?php

namespace App\Http\Controllers\Admin;

use App\Administrator;
use App\Breakfast;
use App\ExtraService;
use App\Http\Controllers\AdminPagesController;
use App\Reservation;
use App\Room;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReservationController extends AdminPagesController
{
    private $reservationsInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate($this->reservationsInPage);

        return $this->renderOutputAdmin("reservations.list", [
            "reservations" => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $room_id
     * @return Factory|View
     */
    public function create()
    {
        $users = User::all();
        $rooms = Room::all();
        $breakfastsInfo = Breakfast::all();
        $extra_serviceInfo = ExtraService::all();
        $administrators = Administrator::all();

        return $this->renderOutputAdmin('reservations.form', [
            'route' => route('admin.reservations.store'),
            'users' => $users,
            'rooms' => $rooms,
            'breakfastsInfo' => $breakfastsInfo,
            'extra_serviceInfo' => $extra_serviceInfo,
            'administrators' => $administrators
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
        $validator = Validator::make($request->all(), [
            'arrival' => 'required|date|after:yesterday',
            'departure' => 'required|date|after:arrival',
        ]);

        if ($validator->fails()) {
            return response()->json(['mess' => $validator->errors()->all(), 'success' => false], 400);
        }

        // Create the request
        Reservation::create($request->all());

        return redirect()->route('admin.reservations.index')->withSuccess('Бронь успешно добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $users = User::all();
        $rooms = Room::all();
        $breakfasts = Breakfast::all();
        $extraservicesInfo = ExtraService::all();
        $administrators = Administrator::all();

        $reservation = Reservation::whereId($id)->first();
        return $this->renderOutputAdmin("reservations.form", [
            'users' => $users,
            'rooms' => $rooms,
            'breakfastsInfo' => $breakfasts,
            'extra_serviceInfo' => $extraservicesInfo,
            'administrators' => $administrators,
            "reservation" => $reservation,
            "route" => route("admin.reservations.update", ["id_reservation" => $id]),
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
    public function update(Request $request, Reservation $reservation)
    {
        Reservation::whereId($reservation->id)->update($request->all());

        return redirect()->route("admin.reservation.index")->withSuccess("Бронь успешно изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        Reservation::whereId($reservation->id)->delete();

        return redirect()->route("admin.reservation.index")->withSuccess("Должность успешно изменена");
    }
}
