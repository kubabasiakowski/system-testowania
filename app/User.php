<?php
 
namespace App;

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
        'name', 'surname', 'email', 'login', 'password', 'index_number','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Użytkownik ma wiele testów
    */
    public function tests()
    {
        return $this->hasMany('App\Test');
    }

    /**
    * Użytkownik(prowadzacy) ma wiele szablonów testów
    */
    public function testtemplates()
    {
        return $this->hasMany('App\TestTemplate');
    }

    /**
    *Uzytkownik (prowadzący) moze prowadzic wiele przedmiotow
    */
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    public function user_answers()
    {
        return $this->hasMany('App\UserAnswer');
    }
}

