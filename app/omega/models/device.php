<?php

namespace App\omega\models;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    static $rules = [
        'ip' => "required|unique:devices,ip",
        'location' => "required"
    ];

    protected $fillable  = ['ip','location'];

    // public function getRouteKeyName()
    // {
    //     return 'ip';
    // }

    public function status()
    {
        return $this->hasMany('App\omega\models\status');
    }

    public static function isExist($ip)
    {
        return static::whereIp($ip)->count();
    }
}
