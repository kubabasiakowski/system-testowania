<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use App\Question;
use App\Subject;
use App\Category;
use App\Answer;
use App\TestTemplate;
use App\Test;

use App\Http\Requests\AddAnswersRequest;
use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddQuestionRequest;
use App\Http\Requests\AddTestRequest;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    public function teacher()
    {
    	return view('teacher.teacher');
    }

    public function allQuestions()
    {
        $categories = Category::all();
        $questions = Question::orderBy('Category', 'asc')->paginate(10);
        return view('teacher.allQuestions')->with('questions', $questions)->with('categories', $categories);
    }

    public function searchQuestion(Request $request)
    {
        $searchBy = $request->searchBy;
        $searchValue = $request->search;
        $categories = Category::all();
        if($searchBy==1)
            $questions = DB::table('questions')->select(DB::raw("*"))->where('question_content', '=', $searchValue)->paginate(10);
        elseif($searchBy==2)
            $questions = DB::table('questions')->select(DB::raw("*"))->where('points', '=', $searchValue)->paginate(10);
        elseif($searchBy==3)
            $questions = DB::table('questions')
        ->join('categories', 'questions.category_id', '=', 'categories.id')
        ->select(DB::raw("*"))->where('name', '=', $searchValue)->paginate(10);

        return view('teacher.searchQuestion')->with('questions', $questions)->with('categories', $categories);
    }

    public function editQuestion($id)
    {
        $question = Question::findOrFail($id);
        $answers = Answer::where('question_id', $question->id)->get();
        foreach ($answers as $answer) {
            DB::table('answers')->where('id', '=', $answer->id)->delete();
        }
        DB::table('questions')->where('id', '=', $question->id)->delete(); 
        Session::flash('question_deleted', 'Pytanie zostało usunięte.');
        return back();
    }
   
    public function createTest()
    {
        $subjects = Subject::where('user_id', Auth::user()->id)->pluck('name','id');
    	return view('teacher.createTest', compact('subjects'));
    }
    
    public function addTest(AddTestRequest $request)
    {
        $subjectID = $request->subject_id;
        $subjectQuestions = DB::table('questions')
        ->join('categories', 'questions.category_id', '=', 'categories.id')
        ->join('subjects', 'categories.subject_id', '=', 'subjects.id')
        ->select('questions.*')->where('subjects.id', $subjectID)->count();

        if($request->number_of_questions<=$subjectQuestions){
            TestTemplate::create($request->except('testPasswordConfirm'));
            Session::flash('test_added', 'Test został dodany do bazy, przejdz do stworzonych testów w celu jego aktywacji.');
        } else {
            Session::flash('wrongQuestionNumber', 'Wymagana liczba pytań nie jest dostepna w bazie dla podanego przedmiotu. Istniejąca liczba pytań dla wybranego przedmiotu to: '.$subjectQuestions);
        }
        return redirect('/createTest');
    }

    public function activeTests()
    {
        $subjects = Subject::all();
        $activeTests = TestTemplate::where('user_id', Auth::user()->id)->where('is_active', 'true')->orderBy('created_at', 'asc')->paginate(20);
        $countActiveTest = $activeTests->count();
    	return view('teacher.activeTests', compact('activeTests', 'subjects','countActiveTest'));
    }

    public function yourTests()
    {

        $subjects = Subject::all();
        $testTemplates = TestTemplate::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(10);
    	return view('teacher.yourTests', compact('testTemplates', 'subjects'));
    }

    public function activateTest($id)
    {
        $testTemplate = TestTemplate::findOrFail($id);
        if($testTemplate->is_active == 'true')
            $testTemplate->is_active = 'false';
        else
            $testTemplate->is_active = 'true';
        $testTemplate->save();
        return redirect('/yourTests');
    }

    public function questions()
    {
        $subjects = Subject::where('user_id', Auth::user()->id)->pluck('name','id');
        $activeUserCategories = DB::table('subjects')->join('categories', 'subjects.id', '=', 'categories.subject_id')->join('users', 'subjects.user_id', '=', 'users.id')->select('categories.*')->where('users.id','=',Auth::user()->id)->get();
        $categories = $activeUserCategories->pluck('name','id');
        $group = Question::pluck('group_of_students');
        return view('teacher.questions', compact('subjects', 'categories', 'group'));
    }

    public function addQuestion(AddQuestionRequest $request)
    {
        $question = $request->except('subject_id');
        
        $id = DB::table('questions')->insertGetId($question);

        //Question::create($request->all());

        return view('teacher.addAnswers', compact('question', 'id'));//->with('question', $question);
    }

    public function addAnswers(AddAnswersRequest $request)
    {
        $check = 0;
        for($i = 1; $i<=6;$i++)
        {
            $answer_content = $request->input('answer'.$i);
            if(!is_null($answer_content))
            {
                $answer = new Answer;
                $answer->question_id = $request['question_id'];
                
                $answer->answer_content = $answer_content;
                if($request->get('answer'.$i.'_isCorrect')==1)
                {
                    $answer->is_correct = 'true';
                }else{
                    $answer->is_correct = 'false';
                }
                
                $answer->save(); 
                $check++;
            }
            else{

            }
        }

        if($check>0){
            Session::flash('answers_added', 'Odpowiedzi zostały dodane do bazy.');
        }

        return redirect('/questions');
    }

    public function addCategory(AddCategoryRequest $request)
    {

        Category::create($request->all());
        Session::flash('category_added', 'Kategoria została dodana do bazy.');

        return redirect('/questions');

    }

    public function addSubject(AddSubjectRequest $request)
    {
        Subject::create($request->all());
        Session::flash('subject_added', 'Przedmiot został dodany do bazy.');

        return redirect('/questions');
    }

    public function findCategory(Request $request)
    {
        $cat = Category::select('name','id')->where('subject_id', $request->id)->take(100)->get();

        return response()->json($cat);
    }

    public function scores()
    {
        $tests = Test::paginate(10);
        return view('teacher.scores', compact('tests'));
    }

    public function searchTest(Request $request)
    {
        $searchBy = $request->searchBy;
        $searchValue = $request->search;
        if($searchBy==1)
            $tests = Test::join('users', 'tests.user_id', '=', 'users.id')->select('tests.*')->where('users.surname', '=', $searchValue)->paginate(10);
        elseif($searchBy==2)
            $tests = Test::join('test_templates', 'tests.test_template_id', '=', 'test_templates.id')->join('subjects', 'test_templates.subject_id', '=', 'subjects.id')->select(DB::raw('tests.*'))->where('subjects.name', '=', $searchValue)->paginate(10);
        elseif($searchBy==3)
            $tests = Test::select(DB::raw('tests.*'))->where('mark', '=', $searchValue)->paginate(10);

        return view('teacher.searchTest')->with('tests', $tests);
    }
}
