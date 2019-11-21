<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>'welcome']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var = Auth::user()->status;
        if($var=='student')
            return view('student.homeStudent');
        elseif($var=='administrator')
            return view('admin.homeAdmin');
        elseif($var=='prowadzacy')
            return view('teacher.homeTeacher');
    }

    public function welcome()
    {
        if(!Auth::check())
            return view('welcome');
        else
            return redirect('home');
    }

}
