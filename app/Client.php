<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'surname', 'email', 'address', 'state', 'country',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function creditCards()
    {
        return $this->hasMany('App\CreditCard');
    }
}
