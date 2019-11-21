<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [ 'name',
        'subject_id' ];


    /**
    *Kategoria należy do jednego przedmiotu
    */
    public function subject()
    {
    	return $this->belongsTo('App\Subject');
    }
    /**
    *Kategoria zawiera wiele pytan
    */
    public function questions()
    {
    	return $this->hasMany('App\Question');
    }
}
