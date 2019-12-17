<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function room() {
        return $this->belongsTo('App\Room');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function administrator() {
        return $this->belongsTo(Administrator::class, 'administrator_id');
    }
}
