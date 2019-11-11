<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends AdminPagesController
{
    private $staffInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate($this->staffInPage);
        return $this->renderOutputAdmin("roles.list", [
            "roles" => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $room_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return $this->renderOutputAdmin('roles.form', [
            'route' => route('admin.roles.store'),
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
        Role::create($request->all());

        return redirect()->route("admin.roles.index")->withSuccess("Должность успешно добавлена");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::whereId($id)->first();
        return $this->renderOutputAdmin("roles.form", [
            "role" => $role,
            "route" => route("admin.role.update", ["id_role" => $id]),
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
    public function update(Request $request, Role $role)
    {

        Role::whereId($role->id)->update($request->all());

        return redirect()->route("admin.roles.index")->withSuccess("Работник успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::whereId($role->id)->destroy();

        return redirect()->route("admin.roles.index")->withSuccess("Должность успешно изменена");
    }
}
