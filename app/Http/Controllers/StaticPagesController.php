<?php

namespace App\Http\Controllers;

use App\Breakfast;
use App\ExtraService;
use App\Reservation;
use App\Room;
use Illuminate\Http\Request;

class StaticPagesController extends AdminPagesController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function reservation()
    {
//        $reservations = Reservation::where('user_id', Auth::id())
//            ->orderBy('arrival', 'asc')
//            ->get();
//
//        return $this->renderOutput('dashboard.reservations')->with('reservations', $reservations);
    }

    public function reservation_create($room_id)
    {
//        $roomInfo = Room::find($room_id)->get();
//        $breakfastsInfo = Breakfast::all();
//        $extra_serviceInfo = ExtraService::all();
//        return  $this->renderOutput('dashboard.reservationCreate', compact('roomInfo', 'breakfastsInfo', 'extra_serviceInfo'));
    }

    public function admin()
    {
        return $this->renderOutputAdmin('layouts.admin_app');
    }

}
