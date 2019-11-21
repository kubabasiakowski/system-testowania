<?php

use Illuminate\Database\Seeder;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$correct = 'false';
    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 1 z Algorytmow';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 1;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 2 z Algorytmow';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 2;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 3 z Algorytmow';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 3;
	        $answer->save();
    	}
    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 1 z Modele danych';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 4;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 2 z Modele danych';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 5;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 3 z Modele danych';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 6;
	        $answer->save();
    	}
    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 1 z Instrukcje warunkowe';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 7;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 2 z Instrukcje warunkowe';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 8;
	        $answer->save();
    	}

    	for($i = 1 ; $i <= 5; $i++)
    	{
	        $answer = new Answer();
	        $answer->answer_content = 'Odpowiedź nr '.$i.' do pytania 3 z Instrukcje warunkowe';
	        if($correct=='false')
	        	$correct='true';
	        else 
	        	$correct ='false';

	        $answer->is_correct = $correct;
	        $answer->question_id = 9;
	        $answer->save();
    	}

    }
}
