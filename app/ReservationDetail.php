<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'adults', 'children', 'subtotal',
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function suite()
    {
        return $this->belongsTo('App\Suite');
    }
}
