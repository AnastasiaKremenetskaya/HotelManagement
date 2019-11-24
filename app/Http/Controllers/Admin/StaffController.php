<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use App\Role;
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
        $roles = Role::all();

        return $this->renderOutputAdmin('staff.form', [
            'route' => route('admin.staff.store'),
            'roles' => $roles
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
        Staff::create($request->all());

        return redirect()->route("admin.staff.index")->withSuccess("Пользователь успешно добавлен");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return Factory|View
     */
    public function edit($id)
    {
        $roles = Role::all();
        $staff = Staff::whereId($id)->first();

        return $this->renderOutputAdmin("staff.form", [
            "staff" => $staff,
            'roles' => $roles,
            "route" => route("admin.staff.update", ["id_staff" => $id]),
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
    public function update(Request $request, Staff $staff)
    {

        Staff::whereId($staff->id)->update($request->all());

        return redirect()->route("admin.staff.index")->withSuccess("Работник успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        Staff::whereId($staff->id)->destroy();

        return redirect()->route("admin.staff.index")->withSuccess("Работник успешно изменен");
    }
}
