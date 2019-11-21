<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class TestTemplate extends Model
{
    protected $table = 'test_templates';
    protected $fillable = [
        'user_id',
        'subject_id',
        'is_active',
        'number_of_questions',
    	'time',
        'testPassword'];



    /**
        Szablon testu posiada jednego właściciela
    */  
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
    * Szablon testu posiada wiele testow
    */
    public function tests()
    {
        return $this->hasMany('App\Test');
    }

	/**
    * Szablon testu należy do jednego przedmiotu
    */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }


}
