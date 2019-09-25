<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmentation extends Model
{
    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
