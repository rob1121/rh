<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $fillable  = [
            'ip','location', 'position', 'rh_min','rh_max','temp_min','temp_max'
    ];

    protected $hidden = [
      "created_at", "updated_at"
    ];

//    protected $with = [
//        "monitor"
//    ];

    public static function instance(Array $request)
    {
        return collect(new self($request))->toArray();
    }

    public function monitor()
    {
        return $this->hasMany(Monitor::class);
    }

    public function setLocationAttribute($value) {
        $this->attributes['location'] = trim($value);
    }

    public function setIpAttribute($value) {
        $this->attributes['ip'] = trim($value);
    }
}
