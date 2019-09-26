<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suite extends Model
{
    protected $fillable = [
        'title', 'number', 'bed_number', 'bed_type',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'resourceId');
    }

    public function rates()
    {
        return $this->hasMany('App\Rate');
    }

    public function reservation_details()
    {
        return $this->hasMany('App\ReservationDetail');
    }
}