<?php namespace App\omega\Traits;


use Carbon\Carbon;

trait DateTime {
    public static function today()
    {
        return Carbon::now('Asia/Manila');
    }

    public static function dateString()
    {
        return static::today()->toDateString();
    }

    public static function year()
    {
        return static::today()->year;
    }

    public static function month()
    {
        return static::today()->month;
    }
}