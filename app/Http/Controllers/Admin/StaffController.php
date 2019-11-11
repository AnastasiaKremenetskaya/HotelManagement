<?php

namespace App\Http\Controllers\Admin;

use App\Breakfast;
use App\ExtraService;
use App\Http\Controllers\AdminPagesController;
use App\Room;
use App\Staff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StaffController extends AdminPagesController
{
    private $staffInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $staff = Staff::orderBy('created_at', 'desc')->paginate($this->staffInPage);
        return $this->renderOutputAdmin("staff.list", [
            "staff" => $staff
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
        $rooms = Room::all();
        $breakfastsInfo = Breakfast::all();
        $extra_serviceInfo = ExtraService::all();
        return $this->renderOutputAdmin('reservations.form', [
            'route' => route('admin.reservations.store'),
            'rooms' => $rooms,
            'breakfastsInfo' => $breakfastsInfo,
            'extra_serviceInfo' => $extra_serviceInfo
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
        $user_id = Auth::id();
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

        if ($reservation->user_id === Auth::id())
        {
            $roomInfo = Room::all();
            $breakfastsInfo = Breakfast::all();
            $extra_serviceInfo = ExtraService::all();

            return view('dashboard.reservationEdit', compact('reservation', 'roomInfo', 'breakfastsInfo', 'extra_serviceInfo'));
        }
        else
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to do that');
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

        if ($reservation->user_id != Auth::id())
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to update this reservation');
        $user_id = Auth::id();
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
        if ($reservation->user_id === Auth::id()) {
            $reservation->delete();
            return redirect('dashboard/reservations')->with('success', 'Successfully deleted your reservation!');
        } else
            return redirect('dashboard/reservations')->with('error', 'You are not authorized to delete this reservation');
    }
}
