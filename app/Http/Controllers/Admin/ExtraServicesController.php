<?php

namespace App\Http\Controllers\Admin;

use App\ExtraService;
use App\Http\Controllers\AdminPagesController;
use Illuminate\Http\Request;

class ExtraServicesController extends AdminPagesController
{
    private $extraServInPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $extra_services = ExtraService::paginate($this->extraServInPage);
        return $this->renderOutputAdmin("extra_services.list", [
            "extra_services" => $extra_services
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

        return $this->renderOutputAdmin('extra_services.form', [
            'route' => route('admin.extra_services.store'),
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
        ExtraService::create($request->all());

        return redirect()->route("admin.extra_services.index")->withSuccess("Доп услуга успешно добавлена");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $extra_service = ExtraService::whereId($id)->first();
        return $this->renderOutputAdmin("extra_services.form", [
            "extra_service" => $extra_service,
            "route" => route("admin.extra_services.update", ["id_extra_service" => $id]),
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
    public function update(Request $request, ExtraService $extraService)
    {

        ExtraService::whereId($extraService->id)->update($request->all());

        return redirect()->route("admin.extra_services.index")->withSuccess("Доп услуга успешно изменена");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $extraService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExtraService::whereId($id)->delete();

        return redirect()->route("admin.extra_services.index")->withSuccess("Доп услуга успешно удалена");
    }
}
