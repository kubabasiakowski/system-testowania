<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    protected $fillable = [
        'user_id',
        'test_template_id',
        'mark',
        'points'];



    /**
        Test posiada jednego właściciela
    */  
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
    * Test posiada jeden szablon
    */
    public function test_template()
    {
        return $this->belongsTo('App\TestTemplate');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

    public function user_answers()
    {
        return $this->hasMany('App\UserAnswer');
    }
}
