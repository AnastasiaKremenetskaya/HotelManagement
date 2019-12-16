<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use App\Role;
use App\Staff;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        //$staff = DB::select('select * from staff order by created_at desc');

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
        //$roles = Role::all();
        $roles = DB::select('select * from roles');
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
        Staff::create([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'date_of_birth' => $request->date_of_birth,
            'salary' => $request->salary,
            'phone' => $request->phone
        ]);

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
        $staff = DB::select('select * from staff where id = :id', ['id' => $id]);//Staff::whereId($id)->first();

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
        Staff::whereId($staff->id)->delete();

        return redirect()->route("admin.staff.index")->withSuccess("Работник успешно изменен");
    }
}
