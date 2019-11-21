<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for($i = 1 ; $i <= 3; $i++)
    	{
	        $question = new Question();
	        $question->question_content = 'Pytanie nr '.$i.' z kategorii Algorytmy';
	        $question->category_id = 1;
	        $question->group_of_students = 'stacjonarne';
	        $question->points =  5;
	        $question->save();
        }

        for($i = 1 ; $i <= 3; $i++)
    	{
	        $question = new Question();
	        $question->question_content = 'Pytanie nr '.$i.' z kategorii Modele danych';
	        $question->category_id = 2;
	        $question->group_of_students = 'stacjonarne';
	        $question->points =  5;
	        $question->save();
        }

        for($i = 1 ; $i <= 3; $i++)
    	{
	        $question = new Question();
	        $question->question_content = 'Pytanie nr '.$i.' z kategorii Instrukcje warunkowe';
	        $question->category_id = 3;
	        $question->group_of_students = 'stacjonarne';
	        $question->points =  5;
	        $question->save();
        }
    }
}
