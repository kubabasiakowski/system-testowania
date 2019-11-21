<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>'admin'], function() {
	Route::get('/admin', 'AdminController@admin');

	Route::get('/allTests', 'AdminController@allTests');

	Route::get('/allUsers', 'AdminController@allUsers');
	Route::get('/allUsers/{id}', 'AdminController@editUser')->name('editUser');
	Route::get('/searchUser', 'AdminController@searchUser')->name('searchUser');
	Route::post('/allUsers/{id}', 'AdminController@editUserStatus');
	Route::post('/deleteUser', 'AdminController@deleteUser');
});

Route::group(['middleware'=>['teacher', 'web']], function() {
	Route::get('/teacher', 'TeacherController@teacher');
	Route::get('/allQuestions', 'TeacherController@allQuestions');
	Route::get('/searchQuestion', 'TeacherController@searchQuestion')->name('searchQuestion');
	Route::get('/allQuestions/{id}', 'TeacherController@editQuestion');


	Route::get('/createTest', 'TeacherController@createTest');
	Route::post('/addTest', 'TeacherController@addTest');


	Route::get('/activeTests', 'TeacherController@activeTests');
	Route::get('/yourTests', 'TeacherController@yourTests');
	Route::get('/yourTests/{id}', 'TeacherController@activateTest');

	Route::get('/questions', 'TeacherController@questions');
	Route::get('/addQuestion', 'TeacherController@addQuestion');
	Route::post('/addCategory', 'TeacherController@addCategory');
	Route::post('/addSubject', 'TeacherController@addSubject');
	Route::get('/addAnswers', 'TeacherController@addAnswers');

	Route::get('/scores', 'TeacherController@scores');
	Route::get('/searchTest', 'TeacherController@searchTest')->name('searchTest');
});

Route::group(['middleware'=>'student'], function() {
	Route::get('/student', 'StudentController@student');

	Route::get('/solvedTests', 'StudentController@solvedTests');
	Route::get('/solvedTests/{id}', 'StudentController@testDetails');

	Route::get('/availableTests', 'StudentController@availableTests');
	Route::get('/availableTests/{id}', 'StudentController@enterTestPassword');
	Route::post('/passwordConfirmed', 'StudentController@createTest');
	Route::get('/test', 'StudentController@showTest');
	Route::get('/test/{id}', 'StudentController@singleQuestion');
	Route::post('/test/{id}', 'StudentController@addUserAnswers')->name('addUserAnswers');
	Route::get('/finish', 'StudentController@finish');
});

	Route::get('/findCategory', 'TeacherController@findCategory');