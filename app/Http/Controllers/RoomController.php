<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();//Room::query('')
        return view('rooms')->with('rooms', $rooms);
    }
}
