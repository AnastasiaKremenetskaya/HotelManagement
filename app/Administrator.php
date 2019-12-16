<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $guarded = [];
    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
