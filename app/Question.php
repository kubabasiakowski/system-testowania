<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'question_content',
        'category_id',
        'points',
        'group_of_students'];
    /**
    *Pytanie nalezy do kategorii
    */
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    /**
    *Pytanie posiada wiele odpowiedzi
    */
    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }

    public function tests()
    {
        return $this->belongsToMany('App\Test');
    }
}
