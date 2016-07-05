<?php

namespace App\omega\models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $fillable = ['ip','location','rh','temp'];
}
