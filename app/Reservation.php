<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'title', 'folio', 'checkin', 'checkout', 'payment_method', 'start', 'end', 'total', 'notas',
    ];

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function credit_card()
    {
        return $this->belongsTo('App\CreditCard');
    }
}
