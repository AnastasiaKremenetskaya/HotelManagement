<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminPagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChartsController extends AdminPagesController
{
    public function avg_rooms_sum() {
        $sum = DB::table('rooms')->avg('price');
        return $sum;
    }
    public function avg_salary() {
        $sum = DB::table('staff')->avg('salary');
        return $sum;
    }
}
