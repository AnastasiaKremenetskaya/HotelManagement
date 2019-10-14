<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', \Auth::user()->getUserInfo()['sub'])
            ->orderBy('arrival', 'asc')
            ->get();
        return view('dashboard.reservations')->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hotel_id)
    {
        $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);
        return view('dashboard.reservationCreate', compact('hotelInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = \Auth::user()->getUserInfo()['sub'];
        $request->request->add(['user_id' => $user_id]);

        // Create the request
        Reservation::create($request->all());
        return redirect('dashboard/reservations')->with('success', 'Reservation created!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $reservation = Reservation::with('room', 'room.hotel')
            ->get()
            ->find($reservation->id);

        if ($reservation->user_id === \Auth::user()->getUserInfo()['sub']) {
            $hotel_id = $reservation->room->hotel_id;
            $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);

            return view('dashboard.reservationSingle', compact('reservation', 'hotelInfo'));
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
        $reservation = Reservation::with('room', 'room.hotel')
            ->get()
            ->find($reservation->id);
        if ($reservation->user_id === \Auth::user()->getUserInfo()['sub']) {
            $hotel_id = $reservation->room->hotel_id;
            $hotelInfo = Hotel::with('rooms')->get()->find($hotel_id);
            return view('dashboard.reservationEdit', compact('reservation', 'hotelInfo'));
        } else
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to do that');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation) {

        if ($reservation->user_id != \Auth::user()->getUserInfo()['sub'])
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to update this reservation');
        $user_id = \Auth::user()->getUserInfo()['sub'];
        $reservation->user_id = $user_id;
        $reservation->num_of_guests = $request->num_of_guests;
        $reservation->arrival = $request->arrival;
        $reservation->departure = $request->departure;
        $reservation->room_id = $request->room_id;

        $reservation->save();

        return redirect('dashboard/reservations')->with('success', 'Successfully updated your reservation!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation = Reservation::find($reservation->id);
        if ($reservation->user_id === \Auth::user()->getUserInfo()['sub']) {
            $reservation->delete();
            return redirect('dashboard/reservations')->with('success', 'Successfully deleted your reservation!');
        } else
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to delete this reservation');
    }
}
