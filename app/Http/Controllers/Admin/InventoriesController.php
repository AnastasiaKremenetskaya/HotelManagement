<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use App\Inventory;
use App\Room;
use Illuminate\Http\Request;

class InventoriesController extends AdminPagesController
{
    private $inventoriesInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $inventories = Inventory::orderBy('created_at', 'desc')->paginate($this->inventoriesInPage);
        return $this->renderOutputAdmin("inventories.list", [
            "inventories" => $inventories
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
        $rooms = Room::all();

        return $this->renderOutputAdmin('inventories.form', [
            'rooms' => $rooms,
            'route' => route('admin.inventories.store'),
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
        Inventory::create($request->all());

        return redirect()->route("admin.inventories.index")->withSuccess("Инвентарь успешно добавлен");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $inventory = Inventory::whereId($id)->first();
        $rooms = Room::all();

        return $this->renderOutputAdmin("inventories.form", [
            'rooms' => $rooms,
            "inventory" => $inventory,
            "route" => route("admin.inventories.update", ["id_inventory" => $id]),
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
    public function update(Request $request, $id)
    {

        Inventory::whereId($id)->update($request->all());

        return redirect()->route("admin.inventories.index")->withSuccess("Инвентарь успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::whereId($id)->delete();

        return redirect()->route("admin.inventories.index")->withSuccess("Инвентарь успешно удален");
    }}
