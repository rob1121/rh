<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'fake_reading', 'hide_offline', 'hide_pl3', 'refreshing_time', 'temp_min', 'rh_min', 'temp_max', 'rh_max',
    ];

    protected $appends = [
      'refreshment_time_to_milli_second'
    ];

    protected $hidden = [
        "updated_at", "created_at", "id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function instance(array $all)
    {
        return (new self($all))->getAttributes();
    }

    public function getRefreshmentTimeToMilliSecondAttribute()
    {
        return $this->refreshing_time * 60 * 1000;
    }
}
