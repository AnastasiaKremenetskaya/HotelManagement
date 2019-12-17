<?php

namespace App\Http\Controllers\Admin;

use App\Administrator;
use App\Cleaner;
use App\Http\Controllers\AdminPagesController;
use App\Role;
use App\Staff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CleanersController extends AdminPagesController
{
    private $administratorsInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $cleaners = Cleaner::orderBy('created_at', 'desc')->paginate($this->administratorsInPage);

        //$administrators = DB::select('select * from administrators order by created_at desc');

        return $this->renderOutputAdmin("cleaners.list", [
            "cleaners" => $cleaners
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
        //$roles = Role::all();
        $rooms = DB::select('select * from rooms');
        $staff = DB::select('select * from staff');

        return $this->renderOutputAdmin('cleaners.form', [
            'route' => route('admin.cleaners.store'),
            'rooms' => $rooms,
            'staff' => $staff
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
        Cleaner::create([
            'staff_id' => $request->staff_id,
            'room_id' => $request->room_id
        ]);

        return redirect()->route("admin.cleaners.index")->withSuccess("Горничный успешно добавлен");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return Factory|View
     */
    public function edit($id)
    {
        $staff = Staff::all();

        $cleaner = DB::select('select * from cleaners where id = :id', ['id' => $id]);//Staff::whereId($id)->first();

        return $this->renderOutputAdmin("cleaners.form", [
            "staff" => $staff,
            'cleaner' => $cleaner,
            "route" => route("admin.cleaners.update", ["id" => $id]),
            "update" => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $requests
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cleaner $cleaner)
    {

        Cleaner::whereId($cleaner->id)->update([
            'staff_id' => $request->staff_id,
            'room_id' => $request->room_id,
        ]);

        return redirect()->route("admin.cleaners.index")->withSuccess("Горничный успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cleaner $cleaner)
    {
        Cleaner::whereId($cleaner->id)->delete();

        return redirect()->route("admin.cleaners.index")->withSuccess("Горничный успешно удален");
    }
}
