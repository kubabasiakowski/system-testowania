<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject();
        $subject->name = 'Teoretyczne podstawy informatyki';
        $subject->user_id = 2;
        $subject->save();

        $subject = new Subject();
        $subject->name = 'Podstawy programowania';
        $subject->user_id = 2;
        $subject->save();

        $subject = new Subject();
        $subject->name = 'Analiza matematyczna';
        $subject->user_id = 2;
        $subject->save();

    }
}
