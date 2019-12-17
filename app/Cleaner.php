<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cleaner extends Model
{
    protected $guarded = [];
    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    public function room() {
        return $this->belongsTo(Staff::class, 'room_id');
    }

}
