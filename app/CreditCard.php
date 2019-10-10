<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'number', 'expiration', 'security_code', 'holder',
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function reservation()
    {
        return $this->hasMany('App\Reservation');
    }
}
