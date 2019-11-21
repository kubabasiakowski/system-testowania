<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $table = 'subjects';
    protected $fillable = [
        'name',
        'user_id'];



    /**
        Przedmiot neleży do użykownika/jest przez niego dodany
    */  
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    
	/**
    *Przedmiot posiada wiele kategorii
    */
	public function categories()
	{
		return $this->hasMany('App\Category');
	}

    /**
     z Przedmiotu może być wiele testów
    */
    public function testtemplates()
    {
        return $this->hasMany('App\TestTemplate');
    }

}
