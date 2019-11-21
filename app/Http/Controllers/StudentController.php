<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;

use App\Subject;
use App\TestTemplate;
use App\Category;
use App\Question;
use App\Answer;
use App\Test;
use App\UserAnswer;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }

    public function student()
    {

    	return view('student.student');
    }

    public function availableTests()
    {

        $subjects = Subject::all();
        $activeTests = TestTemplate::where('is_active', 'true')->orderBy('created_at', 'asc')->paginate(10);
        $countActiveTest = $activeTests->count();
    	return view('student.availableTests', compact('activeTests', 'subjects','countActiveTest'));
    }

    public function enterTestPassword($id)
    {
        $subjects = Subject::all();
        $testTemplate = TestTemplate::findOrFail($id);
        return view('student.enterTestPassword', compact('testTemplate', 'subjects'));
    }

    public function createTest(Request $request)
    {
        if(Session::has('testTemplateId'))
            return redirect('/test');

        $testTemplate = TestTemplate::findOrFail($request->testID);
        $userDidThatTest = DB::table('tests')->select('*')->where('user_id', Auth::user()->id)->where('test_template_id', $testTemplate->id)->count();

        if($request->testTemplatePassword == $testTemplate->testPassword && $userDidThatTest == 0)
        {
            $test = new Test;
            $test->user_id = Auth::user()->id;
            $test->test_template_id = $testTemplate->id;
            $test->points = 0;
            $test->mark = '2';
            $test->save();

            $questions = array(); //tablica przechowujaca pytania

            $subject = Subject::find($testTemplate->subject_id);    //przedmiot
            $categories = $subject->categories()->inRandomOrder()->get();//kategorie przedmiotu
            $categoriesNumber = $subject->categories()->count();


            while(count($questions)<$testTemplate->number_of_questions)
            {
                foreach ($categories as $category) {
                    $question = $category->questions()->inRandomOrder()->first();
                    if(!in_array($question, $questions) && !is_null($question))
                    {
                        $question->tests()->attach($test->id);
                        array_push($questions, $question);
                    }
                    
                }
            }

            Session::put('testTemplateId', $testTemplate->id);
            Session::put('testId', $test->id);
            //return [Session::get('testId'), Session::get('testTemplateId')];
            return redirect('/test');
        }
        elseif($request->testTemplatePassword != $testTemplate->testPassword) 
        {
            Session::flash('password_error', 'Podane hasło jest niepoprawne.');
            return redirect('/availableTests/'.$request->testID);
        }
        elseif($userDidThatTest > 0) 
        {
            Session::flash('is_done_error', 'Wybrany test został już rozwiązany.');
            return redirect('/availableTests/'.$request->testID);
        }
    }

    public function solvedTests()
    {
        $subjects = Subject::all();
        $solvedTests = Test::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(10);
        $countSolvedTests = $solvedTests->count();
        return view('student.solvedTests', compact('solvedTests', 'subjects','countSolvedTests'));
    }

    public function testDetails($id)
    {
        $subjects = Subject::all();
        $solvedTest = Test::findOrFail($id);
        $questions = $solvedTest->questions;

        $answers = Answer::all();
        $userAnswersIDs = UserAnswer::where('user_id', Auth::user()->id)->where('test_id', $solvedTest->id)->orderBy('answer_id')->pluck('answer_id')->toArray();// id odpowiedzi ktore zaznaczyl uzytkownik w swoim tescie

        $maxPointsForAnswers = array(); //maksymalna liczba punktow za pytanie

        $userPoints = array();

        foreach ($questions as $question) {
            $points=0;
            $maxPoints = $question->points;
            array_push($maxPointsForAnswers, $maxPoints);

            $correctAnswersNumber = Answer::where('question_id', $question->id)->where('is_correct', 'true')->count();
            //array_push($correctAnswersNumbers, $correctAnswersNumber);

            $pointsPerAnswer = round($maxPoints/$correctAnswersNumber, 2);
            //array_push($pointsForOneAnswer, $pointsPerAnswer);

            $thisQuestionAnswers = $question->answers()->get();//odpowiedzi aktualnie przerabianego pytania
            foreach ($thisQuestionAnswers as $thisQuestionAnswer) {
                if(in_array($thisQuestionAnswer->id, $userAnswersIDs) && $thisQuestionAnswer->is_correct=='true')
                    $points+=$pointsPerAnswer;
                elseif(in_array($thisQuestionAnswer->id, $userAnswersIDs) && $thisQuestionAnswer->is_correct=='false')
                    $points-=$pointsPerAnswer;
            }
            if($points<0)
                $points=0;
            elseif($points>$maxPoints)
                $points=$maxPoints;
            array_push($userPoints, $points);

        }

        return view('student.testDetails', compact('solvedTest', 'subjects', 'questions', 'userPoints'));
    }

    public function showTest()
    {
        $testTemplate = TestTemplate::findOrFail(Session::get('testTemplateId'));
        $subject = Subject::find($testTemplate->subject_id);
        $test = Test::find(Session::get('testId'));
        $questions = $test->questions()->get();
        $id = 0;


        return view('student.test', compact('testTemplate', 'subject', 'test', 'questions', 'id'));
    }

    public function singleQuestion($id)
    {
        $testTemplate = TestTemplate::findOrFail(Session::get('testTemplateId'));
        $subject = Subject::find($testTemplate->subject_id);
        $test = Test::find(Session::get('testId'));
        $questions = $test->questions()->get();

        $q = array();
        foreach ($questions as $question) {
            array_push($q, $question);
        }

        $singleQuestion = $q[$id-1];
        $answers = $singleQuestion->answers()->get();
        $first_answer = $answers->first();
        $last_answer = $answers->last();
        $userAnswer=array();
        foreach ($answers as $answer) {
            array_push($userAnswer, $answer->user_answers()->get());
        }
        
        return view('student.test', compact('testTemplate', 'subject', 'test', 'questions', 'id', 'singleQuestion', 'answers', 'first_answer', 'last_answer','$userAnswer'));
    }

    public function addUserAnswers($id, Request $request)
    {
        

        $answers = Answer::all();
        $test = Test::find(Session::get('testId'));

        $first = $request->first_answer_id;
        $last = $request->last_answer_id;

        $userAnswers = DB::table('user_answers')
        ->join('answers', 'user_answers.answer_id', '=', 'answers.id')
        ->join('tests', 'user_answers.test_id', '=', 'tests.id')
        ->join('users', 'user_answers.user_id', '=', 'users.id')
        ->select('user_answers.*')
        ->where('user_answers.user_id', Auth::user()->id)
        ->where('user_answers.test_id', $test->id)
        ->whereBetween('user_answers.answer_id', [$first, $last])->get();

        $userAnswersIDs = array();
        foreach ($userAnswers as $userAnswer) {
            array_push($userAnswersIDs, $userAnswer->answer_id);
        }

        DB::table('user_answers')->whereIn('answer_id', $userAnswersIDs)->delete();//usuwanie istniejacych odpowiedzi aby zapisac nowe
        for($next= $first; $next<=$last; $next++)
        {
            Session::forget($next.'checkboxSelected');
        }

        for($next = $first; $next<=$last;$next++)
        {
            if($request->input($next.'_isCorrect')==1)
            {
                $userAnswer = new UserAnswer;
                $userAnswer->user_id = Auth::user()->id;
                $userAnswer->test_id = $test->id;
                $ans = $answers->find($next);
                $userAnswer->answer_id = $ans->id;

                $userAnswer->save();
                Session::put($next.'checkboxSelected', '1');
            }
        }
        $userAnswerExist = DB::table('user_answers')
        ->join('answers', 'user_answers.answer_id', '=', 'answers.id')
        ->join('tests', 'user_answers.test_id', '=', 'tests.id')
        ->join('users', 'user_answers.user_id', '=', 'users.id')
        ->select('user_answers.answer_id')
        ->where('user_answers.user_id', Auth::user()->id)
        ->where('user_answers.test_id', $test->id)
        ->whereBetween('user_answers.answer_id', [$first, $last]);
        Session::put('userAnswerExist'.$id, $userAnswerExist->count());

        //$answerIDsArray = $userAnswerExist->get()->toArray();
        //$answerIDsArray = collect($answerIDsArray)->map(function($x){ return (array) $x; })->toArray();

        //Session::put('userAnswerExist2'.$id, $array);
        //Session::forget('userAnswerExist2'.$id);
        //return $array;
        return back();
    }

    public function finish()
    {
        $test = Test::find(Session::get('testId'));
        $testTemplate = TestTemplate::findOrFail(Session::get('testTemplateId'));
        $subject = Subject::find($testTemplate->subject_id);
        $questionsIDs = DB::table('question_test')->select('question_id')->where('test_id', $test->id)->pluck('question_id')->toArray();
        $questions = Question::whereIn('id', $questionsIDs)->get();

        $questionsIDs = array();
        foreach ($questions as $question) {
            array_push($questionsIDs, $question->id);
        }

        $answers = Answer::all();
        $userAnswersIDs = UserAnswer::where('user_id', Auth::user()->id)->where('test_id', $test->id)->orderBy('answer_id')->pluck('answer_id')->toArray();// id odpowiedzi ktore zaznaczyl uzytkownik w swoim tescie

        $maxPointsForAnswers = array(); //maksymalna liczba punktow za pytanie

        //$correctAnswersNumbers = array(); //liczba poprawnych odpowiedzi pytania

        //$pointsForOneAnswer = array();  // punkty za jedną odpowiedz

        $userPoints = array();

        foreach ($questions as $question) {
            $points=0;
            $maxPoints = $question->points;
            array_push($maxPointsForAnswers, $maxPoints);

            $correctAnswersNumber = Answer::where('question_id', $question->id)->where('is_correct', 'true')->count();
            //array_push($correctAnswersNumbers, $correctAnswersNumber);

            $pointsPerAnswer = round($maxPoints/$correctAnswersNumber, 2);
            //array_push($pointsForOneAnswer, $pointsPerAnswer);

            $thisQuestionAnswers = $question->answers()->get();//odpowiedzi aktualnie przerabianego pytania
            foreach ($thisQuestionAnswers as $thisQuestionAnswer) {
                if(in_array($thisQuestionAnswer->id, $userAnswersIDs) && $thisQuestionAnswer->is_correct=='true')
                    $points+=$pointsPerAnswer;
                elseif(in_array($thisQuestionAnswer->id, $userAnswersIDs) && $thisQuestionAnswer->is_correct=='false')
                    $points-=$pointsPerAnswer;
            }
            if($points<0)
                $points=0;
            elseif($points>$maxPoints)
                $points=$maxPoints;
            array_push($userPoints, $points);

        }
        $testPoints = array_sum($userPoints);
        $maxTestPoints = array_sum($maxPointsForAnswers);

        $percentage = round(($testPoints/$maxTestPoints)*100, 2);
        if($percentage<40)  //ustalenie oceny na podstawie procentowego wyniku
            $mark='2';
        elseif($percentage>=40 && $percentage<50)
            $mark='3';
        elseif($percentage>=50 && $percentage<65)
            $mark='3.5';
        elseif($percentage>=65 && $percentage<75)
            $mark='4';
        elseif($percentage>=75 && $percentage<85)
            $mark='4.5';
        elseif($percentage>=85)
            $mark='5';

        $test->points = $testPoints;
        $test->mark = $mark;
        $test->save();

        Session::forget('testTemplateId');
        Session::forget('testId');

        return view('student.testScore', compact('testPoints', 'maxTestPoints', 'percentage', 'mark', 'subject'));
        //return [$userPoints, $userAnswersIDs, $testPoints, $maxTestPoints, $percentage, $mark];
    }
}