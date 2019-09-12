<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'type', 'price'
    ];
    
    public function suite()
    {
        return $this->belongsTo('App\Suite');
    }
}
