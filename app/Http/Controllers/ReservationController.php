<?php

namespace App\Http\Controllers;

use App\Breakfast;
use App\ExtraService;
use App\Reservation;
use App\Room;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReservationController extends StaticPagesController
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->orderBy('arrival', 'asc')
            ->get();

        return view('dashboard.reservations', compact('reservations', $reservations));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id_room
     * @return Factory|View
     */
    public function create($id_room)
    {
        $roomInfo = Room::find($id_room)->get();
        $breakfastsInfo = Breakfast::all();
        $extra_serviceInfo = ExtraService::all();
        return $this->renderOutput('dashboard.reservationCreate', compact('roomInfo', 'breakfastsInfo', 'extra_serviceInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $requesta
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::id())
            $user_id = Auth::id();

        $request->request->add(['user_id' => $user_id]);

        // Create the request
        Reservation::create($request->all());

        return redirect(route('reservations.index'))->with('success', 'Бронь создана!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($reservation_id)
    {
        $reservation = Reservation::whereId($reservation_id)->get();

        if ($reservation->user_id === Auth::id()) {
            $room_id = $reservation->room_id;
            $roomInfo = Room::with('rooms')->get()->find($room_id);

            return view('dashboard.reservationSingle', compact('reservation', 'roomInfo'));
        } else
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to see that.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $reservation = Reservation::whereId($reservation->id)->first();

        if ($reservation->user_id === Auth::id()) {
            $roomInfo = Room::all();
            $breakfastsInfo = Breakfast::all();
            $extra_serviceInfo = ExtraService::all();

            return view('dashboard.reservationEdit', compact('reservation', 'roomInfo', 'breakfastsInfo', 'extra_serviceInfo'));
        } else
            return redirect('dashboard/reservations')->with('error', 'Авторизуйтесь чтобы продолжить');
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

        $user_id = Auth::id();
        $reservation->user_id = $user_id;
        $reservation->num_of_guests = $request->num_of_guests;
        $reservation->arrival = $request->arrival;
        $reservation->departure = $request->departure;
        $reservation->room_id = $request->room_id;

        $reservation->save();

        return redirect(route('reservations.index'))->with('success', 'Успешно отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        Reservation::find($reservation->id)->delete();
        return redirect(route('reservations.index'))->with('success', 'Успешно удалено!');
    }
}
