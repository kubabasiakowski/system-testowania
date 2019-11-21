<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
	protected $fillable = [
        'answer_id',
        'test_id',
    	'user_id'];
    /**
    *Odpowiedz należy do jednego pytania
    */
    public function answer()
    {
    	return $this->belongsTo('App\Answer');
    }

    public function test()
    {
    	return $this->belongsTo('App\Test');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
