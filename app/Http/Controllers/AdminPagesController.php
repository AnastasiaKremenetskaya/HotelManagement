<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPagesController extends Controller
{
    /**
     * Получение менб для подвала
     *
     * @return array
     */
    function footer(){
        return [];
    }

    /**
     * Плучение списка слайдов
     *
     * @return array
     */
    private function slider(){
        return [];
    }

    /**
     *  Получение пунктов меню
     *
     * @return array - массив пунтов меню
     */
    private function menu(){
        $reservations = Reservation::all();
        return [
            "reservations" => $reservations
        ];
    }

    /**
     * Рендеринг layout элементов макета
     *
     * @param $view
     * @param $vars
     * @return Factory|View
     */
    protected function renderOutput($view, $vars = []){
        return view($view)->with($vars)->with([
            'menu' => $this->menu(),
            'footer' => $this->footer(),
            'slider' => $this->slider()
        ]);
    }

    /**
     * @param $view
     * @param array $vars
     * @return Factory|View
     */
    protected function renderOutputAdmin($view, $vars = [])
    {
        $menu = config("admin_menu");
        return view($view)->with($vars)->withMenu($menu);
    }

    function admin()
    {
        return $this->renderOutputAdmin('layouts.admin_app');
    }
}
