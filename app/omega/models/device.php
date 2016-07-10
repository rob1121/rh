<?php

namespace App\omega\models;

use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    protected $fillable  = ['ip','location'];
    
    public function status()
    {
        return $this->hasMany('App\omega\models\status');
    }
}