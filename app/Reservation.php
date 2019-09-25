<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function details()
    {
        return $this->hasMany('App\ReservationDetail');
    }

    public function segmentation()
    {
        return $this->hasOne('App\Segmentation');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function suite()
    {
        return $this->belongsTo('App\Suite', 'resourceId');
    }
}
