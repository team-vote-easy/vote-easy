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

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

Route::get('/import', 'ImportController@showImport');

Route::post('/import', 'ImportController@import');

Route::get('add-candidates', 'AddController@showAdd');

Route::post('add-candidates', 'AddController@add');

Route::get('/fetch-course', 'FetchController@fetchCourseView');

Route::post('fetch-course', 'FetchController@fetchCourse');

Route::get('fetch-student', 'FetchController@fetchStudentView');

Route::post('fetch-student', 'FetchController@fetchStudent');

Route::get('vue-test', function(){
	return view('vue-test');
});

Route::post('/vue-test', function(Request $request){
	$student = Student::where('matric_no', $request->matric)->first();
		return response()->json($student);
});

Route::get('vue-form', function(){
	$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
	$levels = [100, 200, 300, 400];
	return view('vue-form', [
		'courses'=>$courses,
		'levels'=>$levels

	]);
});

Route::post('vue-form', 'FetchController@vue');

