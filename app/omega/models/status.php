<?php

namespace App\omega\models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $fillable = ['ip','location','rh','temp'];

    public static function location($ip)
    {
        return status::whereIp($ip)->first()->location;
    }
}
