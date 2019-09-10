<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function suite()
    {
        return $this->belongsTo('App\Suite');
    }
}
