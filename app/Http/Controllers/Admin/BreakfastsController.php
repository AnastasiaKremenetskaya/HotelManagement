<?php

namespace App\Http\Controllers\Admin;

use App\Breakfast;
use App\Http\Controllers\AdminPagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BreakfastsController extends AdminPagesController
{
    private $breakfastsInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $breakfasts = DB::select('SELECT * FROM breakfasts');
        return $this->renderOutputAdmin("breakfasts.list", [
            "breakfasts" => $breakfasts
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

        return $this->renderOutputAdmin('breakfasts.form', [
            'route' => route('admin.breakfasts.store'),
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
        DB::insert('INSERT INTO breakfasts VALUES ('.implode(",", $request->all()));
        //Breakfast::create($request->all());

        return redirect()->route("admin.breakfasts.index")->withSuccess("Тип завтрака успешно добавлен");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $breakfast = DB::select('SELECT * FROM breakfasts WHERE id = '.$id);
        //$breakfast = Breakfast::whereId($id)->first();
        return $this->renderOutputAdmin("breakfasts.form", [
            "breakfast" => $breakfast,
            "route" => route("admin.breakfasts.update", ["id_breakfast" => $id]),
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

        Breakfast::whereId($id)->update([
            'type' => $request->type,
            'time' => $request->time
        ]);
//        DB::update('UPDATE breakfasts WHERE');
////            'type' => $request->type,
////            'time' => $request->time
////        ]);


        return redirect()->route("admin.breakfasts.index")->withSuccess("Тип завтрака успешно изменен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $extraService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_breakfast)
    {
        Breakfast::whereId($id_breakfast)->delete();

        return redirect()->route("admin.breakfasts.index")->withSuccess("Тип завтрака успешно удален");
    }
}
