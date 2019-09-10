<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suite extends Model
{
    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'resourceId');
    }

    public function rates()
    {
        return $this->hasMany('App\Rate');
    }
}