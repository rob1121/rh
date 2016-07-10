<?php

namespace App\omega\models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $fillable = ['rh','temp','is_recording'];
    
    public function device()
    {
        return $this->belongsTo('App\omega\models\device');
    }

    public static function location($ip)
    {
        return status::whereIp($ip)->first()->location;
    }
}
