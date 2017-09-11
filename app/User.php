<?php namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id','name', 'email', 'password', "is_admin"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];


    public function config()
    {
        return $this->hasOne(Configuration::class);
    }

    public function scopeEmployeeIdHighestCharCount($query)
    {
        return $query->orderBy("employee_id", "desc")->first()->employee_id;
    }

    public static function instance(Array $request)
    {
        return (new self($request))->getAttributes();
    }
}
