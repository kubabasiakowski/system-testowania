<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

	protected $table = 'answers';
	protected $fillable = [
        'question_id',
        'answer_content',
    	'is_correct'];
    /**
    *Odpowiedz należy do jednego pytania
    */
    public function question()
    {
    	return $this->belongsTo('App\Question');
    }

    public function user_answers()
    {
        return $this->hasMany('App\UserAnswer');
    }
}
 