<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = [
        'rh', 'temp', 'is_recording'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
