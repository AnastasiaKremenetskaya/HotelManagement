<?php

namespace App\Http\Controllers\Admin;

use App\Administrator;
use App\Http\Controllers\AdminPagesController;
use App\Role;
use App\Staff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdministratorsController extends AdminPagesController
{
    private $administratorsInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $administrators = Administrator::orderBy('created_at', 'desc')->paginate($this->administratorsInPage);

        //$administrators = DB::select('select * from administrators order by created_at desc');

        return $this->renderOutputAdmin("administrators.list", [
            "administrators" => $administrators
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
        $staff = DB::select('select * from staff');
        return $this->renderOutputAdmin('administrators.form', [
            'route' => route('admin.administrators.store'),
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
        Administrator::create([
            'staff_id' => $request->staff_id,
        ]);

        return redirect()->route("admin.administrators.index")->withSuccess("Администратор успешно добавлен");
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
        $administrator = DB::select('select * from administrators where id = :id', ['id' => $id]);//Staff::whereId($id)->first();

        return $this->renderOutputAdmin("administrators.form", [
            "staff" => $staff,
            'administrator' => $administrator,
            "route" => route("admin.administrators.update", ["id" => $id]),
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
    public function update(Request $request, Administrator $administrator)
    {

        Administrator::whereId($administrator->id)->update([
            'staff_id' => $request->staff_id
        ]);

        return redirect()->route("admin.administrators.index")->withSuccess("Администратор успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        Administrator::whereId($administrator->id)->delete();

        return redirect()->route("admin.administratorы.index")->withSuccess("Администратор успешно удален");
    }
}
